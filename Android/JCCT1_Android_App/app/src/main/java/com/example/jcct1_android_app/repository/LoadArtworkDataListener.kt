package com.example.jcct1_android_app.repository

import com.example.core.all.entities.entities.Artwork

interface LoadArtworkDataListener {
    fun onArtDataLoaded(artworks: List<Artwork>?)
}