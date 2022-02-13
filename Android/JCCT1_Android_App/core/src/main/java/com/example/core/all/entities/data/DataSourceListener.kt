package com.example.core.all
import com.example.core.all.entities.Museum

interface DataSourceListener {
    fun onDataLoaded(museums: List<Museum>?)
}
