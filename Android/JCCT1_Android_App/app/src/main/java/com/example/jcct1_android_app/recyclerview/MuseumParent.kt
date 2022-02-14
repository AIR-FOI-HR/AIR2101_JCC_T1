package com.example.jcct1_android_app.recyclerview

import com.bignerdranch.expandablerecyclerview.model.Parent
import com.example.core.all.entities.entities.Museum

class MuseumParent(museum: Museum, allMuseums: List<Museum>) : Parent<Museum>,
    Museum(museum.museumId, museum.name, museum.phone, museum.mail, museum.address, museum.layout) {

    var myMuseums = allMuseums.filter { d -> d.museumId == this.museumId }


    override fun getChildList(): List<Museum> {
        return myMuseums
    }

    override fun isInitiallyExpanded(): Boolean {
        return false
    }
}

