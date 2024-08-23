import { Component, Input, Output, EventEmitter } from '@angular/core';
import { People } from 'src/app/interfaces/people';

@Component({
  selector: 'app-person-card',
  templateUrl: './person-card.component.html',
  styleUrls: ['./person-card.component.css']
})
export class PersonCardComponent {
  @Input()
  person!: People; 
  @Output() removeFavorite = new EventEmitter<number>();

  onRemoveFavorite(): void {
    if (this.person && this.person.id) {
      this.removeFavorite.emit(this.person.id);
    }
  }
}
