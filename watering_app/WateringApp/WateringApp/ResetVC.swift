//
//  ResetVC.swift
//  WateringApp
//
//  Created by Brandon Alejandro Mendoza Medina on 12/10/25.
//

import UIKit

class ResetVC: UIViewController {
    
    @IBOutlet weak var emailText: UITextField!
    
    override func viewDidLoad() {
        super.viewDidLoad()
    }
    @IBAction func Reset_click(_ sender: Any) {
        if emailText!.state.isEmpty {
            
            //redplaceholder
            emailText.attributedPlaceholder = NSAttributedString(string: "email", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            }
        else{
            
        }
        }
    }
