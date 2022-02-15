package com.example.jcct1_android_app.repository

import com.example.core.all.entities.entities.Museum
import com.example.ws.WsDataSource
import com.example.core.all.entities.data.DataSource
import com.example.core.all.entities.data.DataSourceListener


class DataRepository {
    fun loadData(listener : LoadDataListener)
    {
        println("Ovdje je nekaj")

        var dataSource : DataSource
        dataSource = WsDataSource()

        dataSource.loadData(
            object : DataSourceListener {
                override fun onDataLoaded(museums: List<Museum>?) {
                    println("Ovdje je nekaj")
                    listener.onDataLoaded(museums)
                }
            }
        )
    }
}