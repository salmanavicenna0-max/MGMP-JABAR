#!/bin/bash
cd /home/server/server/projects/MGMP_JABAR
curl -s -c cookies.txt "http://127.0.0.1:8000/projects/MGMP_JABAR/login" > login.html
TOKEN=$(grep -o 'name="_token" value="[^"]*"' login.html | cut -d'"' -f4 | head -n 1)
curl -s -c cookies.txt -b cookies.txt -X POST "http://127.0.0.1:8000/projects/MGMP_JABAR/login" \
  -d "_token=$TOKEN" -d "email=member@example.com" -d "password=password" \
  -H "Referer: http://127.0.0.1:8000/projects/MGMP_JABAR/login" -I > login_headers.txt
cat login_headers.txt
