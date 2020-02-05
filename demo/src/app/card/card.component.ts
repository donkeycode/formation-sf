import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.scss']
})
export class CardComponent {
  @Input() public user: object;

  appButtonClicked(event) {
    console.log(event, 'appButtonClicked');

    this.user.name = "Hello";
  }

  changeName(newName: string) {
    this.user.name = newName;
  }
}
