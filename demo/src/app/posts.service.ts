import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from './../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class PostsService {

  constructor(private http: HttpClient) { }

  getAllPosts() {
    return this.http.get('https://localhost:8000/api/books');
  }

  getPost(id: number) {
    return this.http.get(environment.apiUrl+'/'+id);
  }
}
