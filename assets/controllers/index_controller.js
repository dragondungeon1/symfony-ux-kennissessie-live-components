import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['name', 'output'];
    //lways generates nameTarget, outputTarget etc..
    //example: appelTarget, peerTarget, etc..

    static values = {
        name: String
    };

    connect() {
        //also works with plural
        if (this.hasNameValue) {
            this._setGreeting(this.nameValue);
        }
    }

    greet() {
        //also works with plural
        this._setGreeting(this.nameTarget.value);
        // this._setGreeting(this.nameTargets);
    }

    _setGreeting(name) {
        this.outputTarget.innerText = `Welkom bij deze demo, ${name}!`;
    }

    pizza() {

    }
}

//targets
//values
//controllers
//classes
