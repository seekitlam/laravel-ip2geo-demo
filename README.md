## About Laravel-IP2Geo-Demo

This repo is my first Laravel project for learning purpose. The goal is to have this microservice serving geolocation data to a map chart. It would:

1. Get IP address from API
2. Obtain geolocation data (latitude, longitude, country name etc.) from an external service
3. Serve geolocation data to a map chart thru WebSocket or Server-Sent Events

Completed items:

- Generate random IPs using model factory and store them in a database (to try out MVC)
- Get geolocation data from [IP-API](https://ip-api.com/docs/api:json)
- Display the IP and results
- Feature tests
- API to lookup an IP

TODO:

- Publish geolocation data WebSocket or Server-Sent Events
- Setup a map chart as the consumer of this microservice

