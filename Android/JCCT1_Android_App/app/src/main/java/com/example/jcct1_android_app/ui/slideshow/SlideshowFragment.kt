package com.example.jcct1_android_app.ui.slideshow

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.TextView
import androidx.core.view.isVisible
import androidx.fragment.app.Fragment
import androidx.fragment.app.FragmentTransaction
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProvider
import androidx.navigation.Navigation
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R
import com.example.jcct1_android_app.databinding.FragmentSlideshowBinding
import com.example.jcct1_android_app.public_data.PublicData.Companion.museumid
import com.example.jcct1_android_app.recyclerview.MuseumParent
import com.example.jcct1_android_app.recyclerview.MuseumRecyclerAdapter
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadMuseumDataListener
import com.example.jcct1_android_app.ui.museumNavigation.MuseumNavigationFragment

class SlideshowFragment : Fragment(), LoadMuseumDataListener {

    var museumTitle: TextView? = null
    var museumDesc: TextView? = null
    var museumNavButton: Button? = null
    private var dataReadyFlag: Boolean = false
    private var viewReadyFlag: Boolean = false
    private lateinit var slideshowViewModel: SlideshowViewModel
    private var _binding: FragmentSlideshowBinding? = null
    private var museum: Museum? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        slideshowViewModel =
            ViewModelProvider(this).get(SlideshowViewModel::class.java)

        _binding = FragmentSlideshowBinding.inflate(inflater, container, false)
        val root: View = binding.root


        return root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        viewReadyFlag = true
        DataRepository().loadMuseumData(this)
        tryToDisplayData()
    }



    override fun onMuseumDataLoaded(museums: List<Museum>?) {

        if (museums != null) {
            for(i in museums.indices){
                if(museums[i].MuseumID == museumid){
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
                    val nextFragment: Fragment = MuseumNavigationFragment()
                    val controller = Navigation.findNavController(requireView())
                    //view
                    controller.navigate(R.id.nav_innerMuseum)
                   // supportFragmentManager
                   // val fragmentManager: FragmentTransaction


                }
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}