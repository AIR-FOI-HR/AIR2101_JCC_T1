package com.example.jcct1_android_app.recyclerview

import android.view.View
import android.widget.ImageView
import android.widget.TextView
import com.bignerdranch.expandablerecyclerview.ParentViewHolder
import com.example.core.all.entities.entities.Museum
import com.example.jcct1_android_app.R
import com.squareup.picasso.Picasso
import org.jetbrains.annotations.NotNull

class MuseumViewHolder(@NotNull itemView : View ) : ParentViewHolder<MuseumParent, Museum>(itemView) {
    var museumName = itemView.findViewById<TextView>(R.id.museum_name)
    var museumDesc = itemView.findViewById<TextView>(R.id.museum_desc)
 //   var museumImage = itemView.findViewById<ImageView>(R.id.museum_image)

    fun bindDataToView(museum: Museum)
    {
        museumName?.text = museum.Name
        museumDesc?.text = museum.Layout
      //  Picasso.with(itemView.context).load(museum.imgUrl).into(storeImage)
    }

}
