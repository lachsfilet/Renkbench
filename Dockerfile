FROM node

ARG buildnumber=1

# Create app directory
WORKDIR /usr/src/app

# Install app dependencies
# A wildcard is used to ensure both package.json AND package-lock.json are copied
# where available (npm@5+)
COPY ./app/package*.json ./

RUN npm install
# If you are building your code for production
# RUN npm ci --only=production

# Bundle app source
COPY ./app .

# Copy app data
COPY ./data ../data

# Set the build number
RUN sed -i "s/\\$\\$\_BUILD\_NUMBER_\\$\\$/${buildnumber}/g" public/workbench.js

RUN npm test

EXPOSE 80
CMD [ "npm", "start" ]