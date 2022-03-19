import { Component, OnInit } from "@angular/core";

@Component({
  selector: "app-register",
  templateUrl: "./register.component.html",
  styleUrls: ["./register.component.scss"],
})
export class RegisterComponent implements OnInit {
  fieldTextType = {
    pass: false,
    repass: false,
  };
  constructor() {}

  ngOnInit() {}
  toggleFieldTextType(i) {
    if (i == 1) {
      this.fieldTextType.pass = !this.fieldTextType.pass;
    } else this.fieldTextType.repass = !this.fieldTextType.repass;
  }
}
