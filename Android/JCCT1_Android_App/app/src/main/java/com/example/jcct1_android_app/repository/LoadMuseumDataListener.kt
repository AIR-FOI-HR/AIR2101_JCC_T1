package com.example.jcct1_android_app.repository

import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum

interface LoadMuseumDataListener {
    fun onMuseumDataLoaded(museums: List<Museum>?)
}
