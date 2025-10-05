//
//  LoginVC.swift
//  WateringApp
//
//  Created by Brandon Alejandro Mendoza Medina on 04/10/25.
//

import UIKit

class LoginVC: UIViewController {
    //UI objects

    @IBOutlet weak var passwordTxt: UITextField!
    @IBOutlet weak var usernameTxt: UITextField!
//    first function
    override func viewDidLoad() {
        super.viewDidLoad()
    }
    //click login bottons
    @IBAction func Login_click(_ sender: UIButton) {
        if usernameTxt.text!.isEmpty || passwordTxt.text!.isEmpty{
            //red placeholders
            usernameTxt.attributedPlaceholder = NSAttributedString(string: "username", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])
            passwordTxt.attributedPlaceholder = NSAttributedString(string: "password", attributes: [NSAttributedString.Key.foregroundColor: UIColor.red ])

        } else {
//            mysql request
            let url = URL(string: "http://localhost/esp8266/login.php")!
            var request = URLRequest(url: url)
            request.httpMethod = "POST"
            let body =  "username=\(usernameTxt.text!.lowercased())&password=\(passwordTxt.text!)"
            
            request.httpBody = body.data(using: .utf8)
            
            let task = URLSession.shared.dataTask(with: request) { data, response, error in
                if let error = error {
                    print("❌ Error: \(error.localizedDescription)")
                    return
                }
                
                guard let data = data else {
                    print("❌ No data received")
                    return
                }
                
                do {
                    if let json = try JSONSerialization.jsonObject(with: data, options: []) as? [String: Any] {
                        print("✅ Response JSON:", json)
                    }
                } catch {
                    print("❌ JSON parse error: \(error.localizedDescription)")
                }
            }
            // 4. Start Task
            task.resume()
                }
            }
        }
    
    

