import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  public title: string = 'demo';

  public users: Array<UserObject> = [
    { name: "Cedric" },
    { name: "Bob" },
    { name: "Rémi" },
  ];
}

interface UserObject
{
  name: string
}
