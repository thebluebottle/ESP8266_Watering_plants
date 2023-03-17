//
//  ContentView.swift
//  watering1
//
//  Created by Brandon Mendoza Medina on 26/01/23.
//

import SwiftUI


struct ContentView: View {
    var body: some View {
        //Color(.blue)
        VStack {
            Gauge(value: 0.8, in: /*@START_MENU_TOKEN@*/0...1/*@END_MENU_TOKEN@*/) {
                /*@START_MENU_TOKEN@*/Text("Label")/*@END_MENU_TOKEN@*/
            }
            Image(systemName: "globe")
                .imageScale(.large)
                .foregroundColor(.accentColor)
            Text("Hello, world!")
        }
        .padding()
    }
    
}



struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
    }
}
