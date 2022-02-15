package com.example.core.all.entities.data

import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum

interface DataSourceListener {
    fun onMuseumDataLoaded(museums: List<Museum>?)
    fun onArtDataLoaded(artworks: List<Artwork>?)
}
