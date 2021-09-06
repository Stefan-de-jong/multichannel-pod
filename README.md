#Proof-of-concept 
"automate the process of storing images as a pdf, using a handwritten code in the image as filename"

This application is a POC demonstrating the automatic retrieval of emails and processing any found attachments with a trained convolutional neural network.

Attachments are stored and resized. After which a trained convolutional neural network will go over the images, looking for a small piece of handwritten code. If found, it will crop out this part of the image and store it separately.

As a follow-up, the idea is that OCR will be used to recognize the extracted code and return this as a string, to be used as filename to convert the original image to PDF.
