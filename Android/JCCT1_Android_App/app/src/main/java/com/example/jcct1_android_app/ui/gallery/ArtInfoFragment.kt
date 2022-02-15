package com.example.jcct1_android_app.ui.gallery

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.core.view.isVisible
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProvider
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.databinding.FragmentGalleryBinding
import com.example.jcct1_android_app.recyclerview.MuseumParent
import com.example.jcct1_android_app.recyclerview.MuseumRecyclerAdapter
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadDataListener

class ArtInfoFragment : Fragment(), LoadDataListener {


    private var viewReadyFlag: Boolean = false
    private var dataReadyFlag: Boolean = false
    private var artworks: List<Artwork>? = null
    private lateinit var artInfoFragmentViewModel: ArtInfoFragmentViewModel
    private var _binding: FragmentGalleryBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        artInfoFragmentViewModel =
            ViewModelProvider(this).get(ArtInfoFragmentViewModel::class.java)

        _binding = FragmentGalleryBinding.inflate(inflater, container, false)
        val root: View = binding.root


        return root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        viewReadyFlag = true
        DataRepository().loadData(this)
        tryToDisplayData()

    }



    override fun onDataLoaded(museums: List<Museum>?) {
        this.artworks= artworks
        dataReadyFlag = true
        tryToDisplayData()
    }


    private fun tryToDisplayData() {
        if (dataReadyFlag  && viewReadyFlag)
        {
            if (artworks != null) {
              //  val parentList : ArrayList<MuseumParent> = ArrayList()
              //  for (s in artworks!!)
              //      parentList.add(MuseumParent(s, artworks!!))

                //prikaz podataka

            }
        }
    }
    

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}