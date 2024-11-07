//
//  ViewController.swift
//  WateringApp
//
//  Created by Brandon Alejandro Mendoza Medina on 22/09/24.
//

import UIKit

class RegistrationVC: UIViewController {
    //UI objects
    @IBOutlet weak var nameTxt: UITextField!
    @IBOutlet weak var emailText: UITextField!
    @IBOutlet weak var usernameTxt: UITextField!
    @IBOutlet weak var passwordTxt: UITextField!
    @IBOutlet weak var surenameTxt: UITextField!
    
    
    //Load Function
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
    }
    //    register button clicked
    @IBAction func RegisterClick(_ sender: Any) {
        if usernameTxt.text!.isEmpty || passwordTxt.text!.isEmpty || emailText.text!.isEmpty || nameTxt.text!.isEmpty || surenameTxt.text!.isEmpty
        {
            //            red placeholders
            usernameTxt.attributedPlaceholder = NSAttributedString(string: "username", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            passwordTxt.attributedPlaceholder = NSAttributedString(string: "password", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            emailText.attributedPlaceholder = NSAttributedString(string: "email", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            nameTxt.attributedPlaceholder = NSAttributedString(string: "name", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            surenameTxt.attributedPlaceholder = NSAttributedString(string: "surename", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
        }
        else{
//            create new user in mySQL
            
        }
        
    }
    
}
