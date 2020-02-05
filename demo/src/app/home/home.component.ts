import { Component, ViewChild, ViewChildren } from '@angular/core';
import { CardComponent } from '../card/card.component';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent {

  @ViewChild(CardComponent, { static: false }) private card: CardComponent;

  public user: object = {
    name: "text"
  }

  public user2: object = {
    name: "text"
  }

  changeThatName()
  {
    this.card.changeName('A new name');
  }
}
