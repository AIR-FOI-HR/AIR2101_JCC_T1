package com.example.core.all.entities.data

import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum

interface MuseumDataSourceListener {
    fun onMuseumDataLoaded(museums: List<Museum>?)

}
