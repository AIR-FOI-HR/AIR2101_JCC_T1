package com.example.jcct1_android_app.ui.gallery

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import com.example.core.all.entities.entities.Artwork
import com.example.jcct1_android_app.databinding.FragmentGalleryBinding
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadArtworkDataListener
import com.example.jcct1_android_app.repository.LoadMuseumDataListener

class ArtInfoFragment : Fragment(), LoadArtworkDataListener {


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
        DataRepository().loadArtData(this)
        tryToDisplayData()

    }



    override fun onArtDataLoaded(artworks: List<Artwork>?) {
        this.artworks= artworks
        dataReadyFlag = true
        tryToDisplayData()
    }


    private fun tryToDisplayData() {
       // if (dataReadyFlag  && viewReadyFlag)
       // {
         //   if (artworks != null) {
              //  val parentList : ArrayList<MuseumParent> = ArrayList()
              //  for (s in artworks!!)
              //      parentList.add(MuseumParent(s, artworks!!))

                //prikaz podataka
        //Ja želim samo jednu sliku, ne sve iz baze. Riješiti sutra i prikazati
                _binding?.textView2?.setText("bla")

         //   }
       // }
    }
    

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}