package com.example.jcct1_android_app.ui.home

import android.content.Context
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
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.MainActivity
import com.example.jcct1_android_app.R
import com.example.jcct1_android_app.databinding.FragmentHomeBinding
import com.example.jcct1_android_app.recyclerview.MuseumParent
import com.example.jcct1_android_app.recyclerview.MuseumRecyclerAdapter
import com.example.jcct1_android_app.repository.DataRepository
import com.example.jcct1_android_app.repository.LoadDataListener

class HomeFragment : Fragment(), LoadDataListener {

    private var viewReadyFlag: Boolean = false
    private var dataReadyFlag: Boolean = false
    private var museums: List<Museum>? = null
    private lateinit var homeViewModel: HomeViewModel
    private var _binding: FragmentHomeBinding? = null

    // This property is only valid between onCreateView and
    // onDestroyView.
    private val binding get() = _binding!!

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        homeViewModel =
            ViewModelProvider(this).get(HomeViewModel::class.java)

        _binding = FragmentHomeBinding.inflate(inflater, container, false)
        val root: View = binding.root

        val textView: TextView = binding.textHome
        homeViewModel.text.observe(viewLifecycleOwner, Observer {
            textView.text = it
        })
        return root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        viewReadyFlag = true
        DataRepository().loadData(this)
        tryToDisplayData()

    }



    override fun onDataLoaded(museums: List<Museum>?) {
        this.museums = museums
        dataReadyFlag = true
        tryToDisplayData()
    }


    private fun tryToDisplayData() {
        if (dataReadyFlag  && viewReadyFlag)
        {
            if (museums != null) {
                val parentList : ArrayList<MuseumParent> = ArrayList()
                for (s in museums!!)
                    parentList.add(MuseumParent(s, museums!!))

                //prikaz podataka
                binding.mainRecycler.adapter = MuseumRecyclerAdapter(requireContext(), parentList)
                binding.mainRecycler.layoutManager = LinearLayoutManager(context)

                //   hiding empty message
                if (museums!!.isNotEmpty())
                    binding.emptyMessage.isVisible = false
            }
        }
    }

 /*   fun loadDataToFragment()
    {

        print("blabla")
        DataRepository().loadData(context, this)
    }*/


    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}