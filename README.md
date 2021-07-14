
Website that allows users to share predictions about their favorite shows, sports, movies etc.  

Website is built with:
backend - php, apache2
frontend - sass(css), react.js, jquery

Mainly was done for the purpose learning and practice.
Project is left unfinished and maybe will continued in the future. 

Main challenges that required some thinking:
1) generating comment section(infinitely threaded, same as Reddit comment section as an example) under created user post 
2) Creating backend with php that passes correct HTTP methods to frontend
3) Creating database queries in a way it would not cause much mess to modify in the future(there were a lot of queries and needed to 
find a way maybe to avoid dublicatin query code).
4) Database structure


Maing goal of the website: 
1) User creates a post predicts the outcome/result/storyline of the target event(sports etc.) or tv show episode/movie.
The user also ADDS A DATE when the event happens or movie/tvshow episode is released. This important because users can give another rating later on.(point 3)

2) Other Users can upvote or downvote if they think the prediction is very good or bad. Users also can leave their comment under the post.
3) When the release date matches current date of that time, the upvote/downvote functionalityy locks and is replaced with rating function where users can vote from 1-5 if they think the prediction was spot on or not. Users can also sort the posts whether they have already in stage 1(upvote/downvote) or stage 2 rating(1-5).

4) Users can sort and search posts based on keywords, genre, popularity. 


