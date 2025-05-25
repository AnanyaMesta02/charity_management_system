import requests
from bs4 import BeautifulSoup

# Step 1: Fetch the webpage
url = 'https://www.justwatch.com/in/tv-show/panchayat'
response = requests.get(url)

# Step 2: Parse the HTML content
soup = BeautifulSoup(response.text, 'html.parser')

# Step 3: Extract the desired information
name = soup.find('h1', class_='title').text.strip()
rating = soup.find('span', class_='sc-16ede01-2').text.strip()
streaming_service = 'Amazon Prime Video'  # Based on the information provided
genre = soup.find('span', class_='sc-16ede01-2').text.strip()  # Adjust the class as needed
synopsis = soup.find('div', class_='sc-16ede01-2').text.strip()  # Adjust the class as needed

# Step 4: Display the extracted information
print(f"Name: {name}")
print(f"Rating: {rating}")
print(f"Streaming Service: {streaming_service}")
print(f"Genre: {genre}")
print(f"Synopsis: {synopsis}")
