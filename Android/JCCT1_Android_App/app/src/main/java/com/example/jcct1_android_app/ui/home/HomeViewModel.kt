package com.example.jcct1_android_app.ui.home

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.repository.LoadDataListener

class HomeViewModel : ViewModel(){

    private val _text = MutableLiveData<String>().apply {
        value = ""
    }
    val text: LiveData<String> = _text


}