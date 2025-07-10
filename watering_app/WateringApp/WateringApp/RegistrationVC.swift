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
            //            read placeholders
            usernameTxt.attributedPlaceholder = NSAttributedString(string: "username", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            passwordTxt.attributedPlaceholder = NSAttributedString(string: "password", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            emailText.attributedPlaceholder = NSAttributedString(string: "email", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            nameTxt.attributedPlaceholder = NSAttributedString(string: "name", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            surenameTxt.attributedPlaceholder = NSAttributedString(string: "surename", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
        }
        else{
//            create new user in mySQL
            let url = URL(string: "http://localhost/esp8266/register.php")!
            var request = URLRequest(url: url)
            request.httpMethod = "POST"
            let body =  "username=\(usernameTxt.text!.lowercased())&password=\(passwordTxt.text!)&email=\(emailText.text!)&fullname=\(nameTxt.text!)%20\(surenameTxt.text!)"
            request.httpBody = body.data(using: .utf8)

            URLSession.shared.dataTask(with: request) { (data:Data?, response:URLResponse?, error:Error?) in
                if error == nil {
//            communicate back to user interface
                    DispatchQueue.main.async {
                        do {
                            let json = try JSONSerialization.jsonObject(with: data!, options: .mutableContainers) as? NSDictionary

                            guard let parseJSON = json else {
                                print("Error while parsing")
                                return
                            }

                            let id = parseJSON["id"]
                            if id != nil{
                                print(parseJSON)
                            }

                        } catch {
                            print("error caught: \(error)")
                        }
                    }
                }
                else{
                    print("error: \(error!)")
                }
            }.resume()
        }
        
    }
    
}
