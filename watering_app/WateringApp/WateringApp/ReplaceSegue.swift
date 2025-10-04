import UIKit

class ReplaceSegue: UIStoryboardSegue {
    override func perform() {
        destination.modalPresentationStyle = .fullScreen
        source.present(destination, animated: false) // or true if you want animation
    }
}
