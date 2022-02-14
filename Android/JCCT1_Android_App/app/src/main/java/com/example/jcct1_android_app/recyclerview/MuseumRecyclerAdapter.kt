package com.example.jcct1_android_app.recyclerview

import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.bignerdranch.expandablerecyclerview.ExpandableRecyclerAdapter
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R
import org.jetbrains.annotations.NotNull

class MuseumRecyclerAdapter(var context: Context,@NotNull parentList: ArrayList<MuseumParent>)
    : ExpandableRecyclerAdapter<MuseumParent, Museum,  MuseumViewHolder, DiscountViewHolder>(parentList) {

    override fun onCreateParentViewHolder(parentViewGroup: ViewGroup, viewType: Int): MuseumViewHolder {
        val itemView : View =
            LayoutInflater.from(context).inflate(R.layout.list_item_museum, parentViewGroup, false)

        return MuseumViewHolder(itemView)
    }

    override fun onCreateChildViewHolder(childViewGroup: ViewGroup, viewType: Int): DiscountViewHolder {
        val itemView : View =
            LayoutInflater.from(context).inflate(R.layout.list_item_museum, childViewGroup, false)

        return DiscountViewHolder(itemView)
    }

    override fun onBindParentViewHolder(parentViewHolder: MuseumViewHolder, parentPosition: Int, parent: MuseumParent) {
        parentViewHolder.bindDataToView(parent)
    }

    override fun onBindChildViewHolder(childViewHolder: DiscountViewHolder, parentPosition: Int, childPosition: Int, child: Museum) {
        childViewHolder.bindDataToView(child)
    }


}
