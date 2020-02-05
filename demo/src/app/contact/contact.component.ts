import { Component } from '@angular/core';
import { FormControl, Validators, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.scss']
})
export class ContactComponent {

  public contactForm: FormGroup = new FormGroup({
    subject: new FormControl('ICI', [
      Validators.required
    ]),
    email: new FormControl('', [
      Validators.required,
      Validators.email
    ])
  });

  onSubmit() {
    if (this.contactForm.valid) {
      console.log(this.contactForm.get('subject').value);
    }
  }

}
