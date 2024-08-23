import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';
import { ApiResponse } from '../interfaces/api-response';

@Injectable({
  providedIn: 'root'
})
export class PeopleService {

  private baseUrl = `${environment.API_URL}`;
  constructor(private http: HttpClient) { }
  getPeople(page: number, searchTerm: string = '', sortBy: string='', sortOrder: string=''): Observable<any> {
    let params = new HttpParams()
      .set('page', page.toString())
      .set('sortBy', sortBy)
      .set('sortOrder', sortOrder);
    if(searchTerm != '')
    {
      params = params.set('search', searchTerm)
    }
      console.log(params.toString());
    return this.http.get<ApiResponse>(`${this.baseUrl}persons`, { params });
  }
  getFavorites(searchTerm: string = ''): Observable<any> {
    const params = new HttpParams().set('search', searchTerm);
    return this.http.get(`${this.baseUrl}favorites`, { params });
  }

  toggleFavorite(id: number): Observable<any> {
    return this.http.patch(`${this.baseUrl}people/${id}/favorite`, {});
  }
}
