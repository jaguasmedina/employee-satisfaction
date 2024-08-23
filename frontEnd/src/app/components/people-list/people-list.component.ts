import { Component } from '@angular/core';
import { ApiResponse } from 'src/app/interfaces/api-response';
import { People } from 'src/app/interfaces/people';
import { PeopleService } from 'src/app/services/people.service';

@Component({
  selector: 'app-people-list',
  templateUrl: './people-list.component.html',
  styleUrls: ['./people-list.component.css']
})
export class PeopleListComponent {
  people: People[] = [];
  currentPage = 1;
  searchTerm = '';
  totalPages = 0;
  sortBy = 'nivel_de_satisfaccion';
  sortOrder = 'asc';

  constructor(private  peopleService: PeopleService) { }

  ngOnInit(): void {
    this.loadPeople();
  }

  loadPeople(): void {
    
    this.peopleService.getPeople(this.currentPage, this.searchTerm, this.sortBy, this.sortOrder).subscribe(
      (apiResponse: ApiResponse) => {
        this.people = apiResponse.data;
        this.totalPages = apiResponse.last_page;
      },
      (error: any) => {
        console.error('Error al cargar personas:', error);
      }
    );
  }

  toggleFavorite(personId: number): void {
    this.peopleService.toggleFavorite(personId).subscribe(() => {
      this.loadPeople();
    });
  }
  goToPreviousPage(): void {
    if (this.currentPage > 1) {
      this.currentPage -= 1;
      this.loadPeople();
    }
  }

  goToNextPage(): void {
    if (this.currentPage < this.totalPages) {
      this.currentPage += 1;
      this.loadPeople();
    }
  }
  
  onSearch(searchTerm: string): void {
    this.searchTerm = searchTerm;
    this.loadPeople();
  }

  onSort(sortBy: string, sortOrder: string): void {
    
    this.sortBy = sortBy;
    this.sortOrder = sortOrder;
    this.loadPeople();
  }
}
