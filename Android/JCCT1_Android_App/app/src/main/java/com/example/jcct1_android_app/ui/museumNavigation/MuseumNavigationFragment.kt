package com.example.jcct1_android_app.ui.museumNavigation

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.databinding.FragmentSlideshowBinding
import com.example.jcct1_android_app.public_data.PublicData
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadArtworkDataListener
import com.example.jcct1_android_app.ui.slideshow.SlideshowViewModel

class MuseumNavigationFragment: Fragment() {

    private lateinit var museumNavigationViewModel: MuseumNavigationViewModel
    var museumTitle: TextView? = null
    var museumDesc: TextView? = null
    var museumNavButton: Button? = null
    private var dataReadyFlag: Boolean = false
    private var viewReadyFlag: Boolean = false

    private var _binding: FragmentSlideshowBinding? = null
    private var museum: Museum? = null

    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        museumNavigationViewModel =
            ViewModelProvider(this).get(MuseumNavigationViewModel::class.java)
        _binding = FragmentSlideshowBinding.inflate(inflater, container, false)

        val root: View = binding.root
        return root
    }

 /*   override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        viewReadyFlag = true
        DataRepository().loadMuseumData(this)
        tryToDisplayData()
    }



    override fun onArtworkDataLoaded(museums: List<Artwork>?) {

        if (museums != null) {
            for(i in museums.indices){
                if(museums[i].MuseumID == PublicData.museumid){
                    museum = museums[i]
                }
            }
        }
        dataReadyFlag = true
        tryToDisplayData()
    }


    private fun tryToDisplayData() {
        if (dataReadyFlag && viewReadyFlag) {
            if (museum != null) {
                // val parentList: ArrayList<MuseumParent> = ArrayList()
                // for (s in museums!!)
                //     parentList.add(MuseumParent(s, museums!!))

                //prikaz podataka
                museumTitle = binding.titleText
                museumTitle?.text = museum?.Name

                museumDesc = binding.descriptionText
                museumDesc?.text = museum?.Layout + museum?.Email + "bla"

                museumNavButton = binding.museumNavigation
                museumNavButton?.setOnClickListener(){
                    val nextFragment: Fragment =
                }
            }
        }
    }
*/
    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }


}