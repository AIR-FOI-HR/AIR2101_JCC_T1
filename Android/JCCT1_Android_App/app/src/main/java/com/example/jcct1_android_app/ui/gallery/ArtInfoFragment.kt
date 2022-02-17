package com.example.jcct1_android_app.ui.gallery

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProvider
import com.example.core.all.entities.entities.Artwork
import com.example.jcct1_android_app.databinding.FragmentGalleryBinding
import com.example.jcct1_android_app.public_data.PublicData
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadArtworkDataListener
import com.example.jcct1_android_app.repository.LoadMuseumDataListener

class ArtInfoFragment : Fragment(), LoadArtworkDataListener {


    private var allArtworks: List<Artwork>? = null
    var artworkTitle: TextView? = null
    var artworkDescription: TextView? = null
    var artworkAuthor: TextView? = null
    private var artwork: Artwork? = null
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
        this.artworks = artworks
        if (artworks!= null) {
            for(i in artworks.indices){
                if(artworks[i].ArtID == PublicData.artid){
                    artwork = artworks[i]
                }
            }
        }
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
        //Ja želim samo jednu sliku, ne sve iz baze. Riješiti sutra i prikazati
                artworkTitle = _binding?.artworkTitle
                artworkAuthor = _binding?.artworkAuthor
                artworkDescription = _binding?.artworkDesc

                artworkTitle?.text = artwork?.Name
                artworkAuthor?.text = artwork?.Author
                artworkDescription?.text = artwork?.Description


            }
        }
    }
    

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}