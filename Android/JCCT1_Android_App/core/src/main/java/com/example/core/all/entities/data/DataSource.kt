package com.example.core.all.entities.data

interface DataSource {
    fun loadMuseumData(museumDataSourceListener: MuseumDataSourceListener)
    fun loadArtworkData(artworkDataSourceListener: ArtworkDataSourceListener)
}