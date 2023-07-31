import { Component } from '@angular/core';

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css']
})
export class LandingComponent {

}

function quickSwitchIntoCard(cursor) {
  cursor = 1;
  let buttons = document.getElementsById("button-circle");
  let cards = document.getElementsById("staff-profiles-carousel");
  
  if (cursor < cards.length)
    cursor = cards.length;
  
  if (cursor > 1)
    cursor = 1;
  
  for (i = 0; i < 2; i++)
    cards[i].style.display = "none";
  
  for (j = 0; j < 2; j++)
    buttons[i].id = buttons[i].id.replace("\tactive", "");
  
  buttons[cursor - 1].id += "\tactive";
  cards[cursor - 1].style.display = "block";
}