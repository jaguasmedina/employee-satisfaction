import { Component } from '@angular/core';
import { People } from 'src/app/interfaces/people';
import { PeopleService } from 'src/app/services/people.service';

@Component({
  selector: 'app-favorites',
  templateUrl: './favorites.component.html',
  styleUrls: ['./favorites.component.css']
})
export class FavoritesComponent {
  favorites: People[] = [];
  searchTerm = '';

  constructor(private  peopleService: PeopleService) { }

  ngOnInit(): void {
    this.loadFavorites();
  }

  loadFavorites(): void {
    this.peopleService.getFavorites(this.searchTerm).subscribe(data => {
      this.favorites = data;
    });
  }

  onSearch(event: Event | string): void {
    if (typeof event === 'string') { 
      this.searchTerm = event;
    }else{
      const inputElement = event.target as HTMLInputElement; 
    this.searchTerm = inputElement.value;
    }
    
    this.loadFavorites();
  }

  removeFavorite(personId: number): void {
    this.peopleService.toggleFavorite(personId).subscribe(() => {
      this.loadFavorites();
    });
  }
}
