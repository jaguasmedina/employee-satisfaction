import { Component, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent {
  @Output() search = new EventEmitter<string>();
  searchTerm: string = '';

  onSearch(): void {
    this.search.emit(this.searchTerm);
  }
}
