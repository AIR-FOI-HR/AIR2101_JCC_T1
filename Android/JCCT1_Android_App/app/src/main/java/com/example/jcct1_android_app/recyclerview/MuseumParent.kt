package com.example.jcct1_android_app.recyclerview

import com.bignerdranch.expandablerecyclerview.model.Parent
import com.example.core.all.entities.entities.Museum

class MuseumParent(museum: Museum, allMuseums: List<Museum>) : Parent<Museum>,
    Museum(museum.MuseumID, museum.Name, museum.Phone, museum.Email, museum.Address, museum.Layout) {

    var myMuseums = allMuseums.filter { d -> d.MuseumID == this.MuseumID }


    override fun getChildList(): List<Museum> {
        return myMuseums
    }

    override fun isInitiallyExpanded(): Boolean {
        return false
    }
}

