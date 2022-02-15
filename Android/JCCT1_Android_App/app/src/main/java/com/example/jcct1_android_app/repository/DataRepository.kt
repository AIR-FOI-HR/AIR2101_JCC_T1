package com.example.jcct1_android_app.repository

import com.example.core.all.entities.entities.Museum
import com.example.ws.WsDataSource
import com.example.core.all.entities.data.DataSource
import com.example.core.all.entities.data.DataSourceListener
import com.example.core.all.entities.entities.Artwork


class DataRepository {
    fun loadMuseumData(listenerMuseum : LoadMuseumDataListener)
    {
        var museumdataSource : DataSource
        museumdataSource = WsDataSource()

        museumdataSource.loadData(
            object : DataSourceListener {
                override fun onMuseumDataLoaded(museums: List<Museum>?) {
                    listenerMuseum.onMuseumDataLoaded(museums)
                }

                override fun onArtDataLoaded(artworks: List<Artwork>?) {
                    TODO("Not yet implemented")
                }
            }
        )
    }

    fun loadArtData(listenerArtwork : LoadArtworkDataListener)
    {
        var artdataSource : DataSource
        artdataSource = WsDataSource()

        artdataSource.loadData(
            object : DataSourceListener {
                override fun onMuseumDataLoaded(museums: List<Museum>?) {
                    TODO("Not yet implemented")
                    //Ovo ne bi trebalo biti ovako? U jednoj funkciji ne moraju biti svi overridei?
                    //Problem sa coreom->data?
                }

                override fun onArtDataLoaded(artworks: List<Artwork>?) {
                    listenerArtwork.onArtDataLoaded(artworks)
                }
            }
        )
    }
}