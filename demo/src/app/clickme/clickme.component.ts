import { Component, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-clickme',
  templateUrl: './clickme.component.html',
  styleUrls: ['./clickme.component.scss']
})
export class ClickmeComponent {

  @Output() plop = new EventEmitter();

  private count: number = 0;

  onButtonClicked() {
    this.count++;
    console.log("Le bouton a été cliqué " + this.count);
    this.plop.emit("Le bouton a été cliqué " + this.count);
  }

}
