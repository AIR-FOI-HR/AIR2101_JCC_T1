package com.example.jcct1_android_app.repository

import com.example.core.all.entities.data.ArtworkDataSourceListener
import com.example.core.all.entities.entities.Museum
import com.example.ws.WsDataSource
import com.example.core.all.entities.data.DataSource
import com.example.core.all.entities.data.MuseumDataSourceListener
import com.example.core.all.entities.entities.Artwork


class DataRepository {
    fun loadMuseumData(listenerMuseum : LoadMuseumDataListener)
    {
        var museumdataSource : DataSource
        museumdataSource = WsDataSource()

        museumdataSource.loadMuseumData(
            object : MuseumDataSourceListener {
                override fun onMuseumDataLoaded(museums: List<Museum>?) {
                    listenerMuseum.onMuseumDataLoaded(museums)
                }

            }
        )
    }

    fun loadArtData(listenerArtwork : LoadArtworkDataListener)
    {
        var artdataSource : DataSource
        artdataSource = WsDataSource()

        artdataSource.loadArtworkData(
            object : ArtworkDataSourceListener {
                override fun onArtDataLoaded(artworks: List<Artwork>?) {
                    listenerArtwork.onArtDataLoaded(artworks)
                }
            }
        )
    }
}