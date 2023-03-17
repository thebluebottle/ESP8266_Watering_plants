//
//  ContentView.swift
//  watering_app
//
//  Created by Brandon Mendoza Medina on 29/01/23.
//

import SwiftUI

struct ContentView: View {
    var body: some View {
        ZStack{
            Color(red: 0.5, green: 0.8, blue: 1.0).edgesIgnoringSafeArea(.all)
            
            Text("Humedad")
                .font(.title)
                .fontWeight(.heavy)
                .foregroundColor(Color.white)
                .padding(.bottom, 550.0)
            VStack {Button("Refresh") {
                /*@START_MENU_TOKEN@*//*@PLACEHOLDER=Action@*/ /*@END_MENU_TOKEN@*/
            }
                Gauge(value: 70, in: 0.0...100.0){
                    Text("Humedad")
                } currentValueLabel: {
                    Text("%")
                        .foregroundColor(.white)
                } minimumValueLabel: {
                    Text("0")
                        .foregroundColor(.white)
                }maximumValueLabel: {
                    Text("100")
                        .foregroundColor(.white)
                }
                .gaugeStyle(AccessoryCircularGaugeStyle())
                .scaleEffect(3)
                .padding(.top, -200.0)
                }
            }
        .padding(.top, 0.0)
        }
    }


struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
    }
}
