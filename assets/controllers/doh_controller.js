import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    send() {
        alert('doh! je kan geen toppings verwijderen als je er geen hebt toegevoegds')
    }
}