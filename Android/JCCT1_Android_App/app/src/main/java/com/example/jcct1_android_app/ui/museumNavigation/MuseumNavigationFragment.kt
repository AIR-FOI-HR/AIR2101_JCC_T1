package com.example.jcct1_android_app.ui.museumNavigation

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import androidx.navigation.Navigation
import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R
import com.example.jcct1_android_app.databinding.FragmentMuseumInnerSpaceBinding
import com.example.jcct1_android_app.public_data.PublicData
import com.example.jcct1_android_app.public_data.PublicData.Companion.artid
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadArtworkDataListener


class MuseumNavigationFragment: Fragment(), LoadArtworkDataListener {

    private lateinit var museumNavigationViewModel: MuseumNavigationViewModel

    private var dataReadyFlag: Boolean = false
    private var viewReadyFlag: Boolean = false
    var artworkButton: Button? = null
    private var _binding: FragmentMuseumInnerSpaceBinding? = null
    private var artwork: Artwork? = null
    private var artworks: List<Artwork>? = null

    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        museumNavigationViewModel =
            ViewModelProvider(this).get(MuseumNavigationViewModel::class.java)
        _binding = FragmentMuseumInnerSpaceBinding.inflate(inflater, container, false)

        val root: View = binding.root
        return root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        viewReadyFlag = true
        DataRepository().loadArtData(this)
        tryToDisplayData()




    }



    override fun onArtDataLoaded(artworksF: List<Artwork>?) {
        this.artworks = artworksF
        dataReadyFlag = true
        tryToDisplayData()
    }


    private fun tryToDisplayData() {
        if (dataReadyFlag && viewReadyFlag) {
            if (artworks != null) {


                //prikaz podataka
                artworkButton = binding.buttonArt
                artworkButton?.setOnClickListener(){
                    PublicData.artid = 1
                    val controller = Navigation.findNavController(requireView())
                    controller.navigate(R.id.nav_gallery)
                }
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }


}