package com.example.ws

import com.example.core.all.entities.data.ArtworkDataSourceListener
import com.example.core.all.entities.data.DataSource
import com.example.core.all.entities.data.MuseumDataSourceListener
import com.example.core.all.entities.entities.Artwork
import com.example.core.all.entities.entities.Museum
import com.example.ws.handlers.MyWebserviceHandler


class WsDataSource : DataSource {
    private var listenerMuseum: MuseumDataSourceListener? = null
    private var listenerArtwork: ArtworkDataSourceListener? = null
    private var museums: List<Museum>? = null
    private var artworks: List<Artwork>? = null

    private var museumsArrived: Boolean = false
    private var artworksArrived: Boolean = false

    @Suppress("UNCHECKED_CAST")
    private val museumHandler: MyWebserviceHandler = object : MyWebserviceHandler{
        override fun <T> onDataArrived(result: List<T>, ok: Boolean) {
            if(ok){
                museums = result as List<Museum>
            }
            museumsArrived = true
            checkMuseumDataArrival()
        }
    }

    @Suppress("UNCHECKED_CAST")
    private val artworkHandler: MyWebserviceHandler = object : MyWebserviceHandler{
        override fun <T> onDataArrived(result: List<T>, ok: Boolean) {
            if(ok){
                artworks = result as List<Artwork>
            }
            artworksArrived = true
            checkArtworkDataArrival()
        }
    }

    override fun loadMuseumData(museumDataSourceListener: MuseumDataSourceListener) {

        this.listenerMuseum = museumDataSourceListener

        val museumCaller: MyWebserviceCaller = MyWebserviceCaller()

        museumCaller.getAllMuseums("getAll", museumHandler)
    }

    override fun loadArtworkData(artworkDataSourceListener: ArtworkDataSourceListener) {
        this.listenerArtwork = artworkDataSourceListener

        val artworkCaller: MyWebserviceCaller = MyWebserviceCaller()

        artworkCaller.getAllArtworks("getAll", artworkHandler)
    }



    private fun checkMuseumDataArrival(){
        if(museumsArrived){
            listenerMuseum?.onMuseumDataLoaded(museums)
        }

    }

    private fun checkArtworkDataArrival(){
        if(artworksArrived){
            listenerArtwork?.onArtDataLoaded(artworks)
        }

    }
}