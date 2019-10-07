import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-render-movies',
  templateUrl: './render-movies.component.html',
  styleUrls: ['./render-movies.component.scss']
})
export class RenderMoviesComponent implements OnInit {
  private HOST: string = 'http://localhost:8000/';
  private queary: string = ''; 
  response: any = '';
  responsePrev: any = '';
  responseFlag: boolean = false;
  private searchQueary: string = '';

  constructor(private http: HttpClient) {
    
  }

  ngOnInit() {
    setInterval(() => {
      if (!this.searchQueary) {
        this.getAll();
      }
    }, 2000);
  }

  getAll () {
    this.http.get(this.HOST)
    .subscribe((response) => {
      this.responsePrev = response;

      this.responsePrev[0].forEach(genre => {
        let i = 0;
        this.responsePrev[1].forEach(movie => {
          if (movie.genre == genre.id) {
            this.responsePrev[1][i].genre = genre.name;
          }
          i++;
        });
      });

      if (!this.responseFlag) {
        this.response = this.responsePrev;
        this.responseFlag = true;
      } else if (JSON.stringify(this.responsePrev[1]) !== JSON.stringify(this.response[1])) {
        this.response = this.responsePrev;
      }
    })
  }

  search () {
    this.http.get(this.HOST + 'search?queary=' + this.searchQueary)
    .subscribe((response) => {
      this.response = response;

      this.response[0].forEach(genre => {
        let i = 0;
        this.response[1].forEach(movie => {
          if (movie.genre == genre.id) {
            this.response[1][i].genre = genre.name;
          }
          i++;
        });
      });
    })
  }
}
