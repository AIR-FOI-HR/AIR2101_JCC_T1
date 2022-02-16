package com.example.core.all.entities.data

import com.example.core.all.entities.entities.Artwork

interface ArtworkDataSourceListener {
    fun onArtDataLoaded(artworks: List<Artwork>?)
}