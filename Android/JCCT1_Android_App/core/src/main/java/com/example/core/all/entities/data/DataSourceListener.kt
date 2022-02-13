package com.example.core.all.entities.data
import com.example.core.all.entities.entities.Museum

interface DataSourceListener {
    fun onDataLoaded(museums: List<Museum>?)
}
