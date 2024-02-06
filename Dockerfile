# Use a base image with the desired runtime environment (e.g., Node.js, Python, etc.)
FROM node:latest 

# Set the working directory inside the container
WORKDIR /app

# Copy package.json and package-lock.json (if present) to the container
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the application code to the container
COPY . .

# Expose the port on which your application will run
EXPOSE 3000

# Define the command to start your applications
CMD ["npm", "start"]
