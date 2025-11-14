-- This is used to create the database for the airbnb clone model. 
CREATE DATABASE IF NOT EXISTS booking_system;
USE booking_system;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(50) NOT NULL,
    lastname varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    phone int(15) NOT NULL,
    password varchar(255) NOT NULL
);

-- Create properties Table
CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    type VARCHAR(50),
    location VARCHAR(100)
);
    
-- dummy properties information
INSERT INTO properties (name, type, location) VALUES
('Empire Bay Villa', 'Villa', 'PramPram'),
('Streicher Beachfront Villa', 'Villa', 'PramPram'),
('Crescent Crove', 'Villa', 'Airport Residential'),
('Airport Tribute House', 'Villa', 'Roman Ridge'),
('Poa Homes', 'Villa', 'East Legon Hills'),
('Solaris', 'Apartment', 'Osu'),
('The Lennox', 'Apartment', 'Airport Residential'),
('Loxwood', 'Apartment', 'Accra'),
('Nova', 'Apartment', 'Roman Ridge');

-- Create listings Table
CREATE TABLE IF NOT EXISTS listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT,
    name VARCHAR(255),
    price DECIMAL(10, 2),
    capacity INT,
    description TEXT,
    cover_img VARCHAR(255),
    FOREIGN KEY (property_id) REFERENCES properties (id) -- a foreign key called property_id that links the room type table to the properties tables, using the primary key from the property table to create a relationship between them.
);

-- dummy listing information
INSERT INTO listings (property_id, name, price, capacity, description, cover_img) VALUES
(1, '5 Bedroom Empire Bay Luxury Beach Villa.', 4931.40, 8, 'Experience ultimate luxury at the 5 Bedroom Empire Bay Luxury Beach Villa, where modern comfort meets breathtaking coastal views.
This expansive beachfront retreat offers five beautifully designed bedrooms, a sparkling private pool, and direct access to the sandy shore — perfect for family vacations, group getaways, or special celebrations.

Inside, you\'ll find bright, airy living spaces, a fully equipped kitchen, and stylish décor that blends elegance with relaxation. Step outside to lounge by the pool, enjoy sunset views from the terrace, or take a few steps to the beach for a morning swim. With premium amenities and a serene location, Empire Bay Villa promises an unforgettable escape.', 'images/empire bay/main.png'),

(2, '3 Bedroom Beachfront Villa', 800.00, 2, 'Wake up to the sound of ocean waves at this charming 3 Bedroom Beachfront Villa.
Designed for those who love the sea, it offers spacious bedrooms, a private balcony overlooking the water, and open-plan living that brings the outdoors in.
Enjoy direct beach access, al fresco dining areas, and a peaceful atmosphere ideal for family vacations or romantic getaways.', 'images/streicher villa/streichermain.png'),

(3, '3 Bedroom Villa', 500.00, 2, 'Discover the perfect blend of comfort and style in this 3 Bedroom Villa.
Featuring bright interiors, a modern kitchen, and a cozy living space, it is the ideal home base for exploring the city.
With a private outdoor area and a location close to shops, dining, and entertainment, you can relax in peace or step out to experience the vibrant local life.', 'images/crescent/C18.png'),

(4, '1-Bedroom Villa @ Airport Tribute House', 750.00, 4, 'Conveniently located near the airport, this 1-Bedroom Villa offers both luxury and accessibility.
Perfect for business travelers or short city stays, it features a sleek modern design, a well-equipped kitchen, and access to shared amenities.
Unwind after your travels in the stylish living area or take advantage of the nearby restaurants and shopping centers.', 'images/airport tribute/A10.png'),

(5, 'Luxury Villa with a Private Pool', 1500.00, 2, 'Indulge in exclusive comfort at this Luxury Villa complete with your own private pool.
Perfect for couples or small groups, the villa boasts a spacious bedroom, designer furnishings, and a tranquil outdoor lounge.
Swim under the stars, enjoy freshly prepared meals in the dining area, and escape the bustle of the city in your own private paradise.', 'images/poa/P10.png'),

(6, 'One Bedroom Executive Apartment', 1500.00, 2, 'Step into modern sophistication at this One Bedroom Executive Apartment in the heart of Osu.
Designed with business and leisure travelers in mind, it offers premium furnishings, a fully fitted kitchen, and close proximity to cultural hotspots.
Enjoy the vibrant neighborhood by day and relax in serene comfort by night.', 'images/solaris/V10.png'),

(7, 'One Bedroom Luxurious Studio Apartment', 2200.00, 3, 'This One Bedroom Luxurious Studio Apartment combines contemporary elegance with practical design.
Featuring a plush sleeping area, a chic kitchenette, and panoramic city views, it is perfect for extended stays or a lavish weekend retreat.
Located near the airport, you’ll have easy access to transportation while enjoying the comfort of high-end amenities.', 'images/lennox/L1.png'),

(8, 'One Bedroom Luxury Apartment at The Loxwood', 1800.00, 4, 'Located in the prestigious Loxwood complex, this One Bedroom Luxury Apartment offers refined living at its finest.
With spacious interiors, a private balcony, and access to building amenities like a fitness center and pool, you’ll enjoy both comfort and convenience.
Ideal for business professionals or couples looking for an upscale city experience.', 'images/loxwood/LOX20.png'),

(9, 'One Bedroom Condo with a Rooftop Pool', 1700.00, 3, 'Experience city living with a twist at this One Bedroom Condo featuring a rooftop pool.
Perfect for young professionals or couples, it includes a stylish living space, modern kitchen, and access to the building’s panoramic rooftop lounge.
Unwind by the pool with a view of the skyline, or explore the vibrant Roman Ridge neighborhood just steps away.', 'images/nova/N1.png');

-- Create bookings Table
CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    listing_id INT,
    user_id INT,
    checkin DATE,
    checkout DATE,
    numof_guests INT,
    total_price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (listing_id) REFERENCES listings (id)
);

CREATE TABLE IF NOT EXISTS property_images (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    listing_id INT, 
    image_url VARCHAR(255), 
    FOREIGN KEY (listing_id) REFERENCES listings(id)
);

INSERT INTO property_images (listing_id, image_url) 
VALUES
(1, 'images/empire bay/EB2.png'),
(1, 'images/empire bay/EB3.png'),
(1, 'images/empire bay/EB4.png'),
(1, 'images/empire bay/EB5.png'),
(1, 'images/empire bay/EB6.png'),
(1, 'images/empire bay/EB7.png'),
(1, 'images/empire bay/EB8.png'),
(1, 'images/empire bay/EB9.png'),
(1, 'images/empire bay/EB10.png'),
(1, 'images/empire bay/EB11.png'),
(2, 'images/streicher villa/S1.png'),
(2, 'images/streicher villa/S2.png'),
(2, 'images/streicher villa/S3.png'),
(2, 'images/streicher villa/S4.png'),
(2, 'images/streicher villa/S5.png'),
(2, 'images/streicher villa/S6.png'),
(2, 'images/streicher villa/S7.png'),
(2, 'images/streicher villa/S8.png'),
(2, 'images/streicher villa/S9.png'),
(3, 'images/crescent/C1.png'),
(3, 'images/crescent/C2.png'),
(3, 'images/crescent/C3.png'),
(3, 'images/crescent/C4.png'),
(3, 'images/crescent/C5.png'),
(3, 'images/crescent/C6.png'),
(3, 'images/crescent/C7.png'),
(3, 'images/crescent/C8.png'),
(3, 'images/crescent/C9.png'),
(3, 'images/crescent/C10.png'),
(3, 'images/crescent/C11.png'),
(3, 'images/crescent/C12.png'),
(3, 'images/crescent/C13.png'),
(3, 'images/crescent/C14.png'),
(3, 'images/crescent/C15.png'),
(4, 'images/airport tribute/A1.png'),
(4, 'images/airport tribute/A2.png'),
(4, 'images/airport tribute/A3.png'),
(4, 'images/airport tribute/A4.png'),
(4, 'images/airport tribute/A5.png'),
(4, 'images/airport tribute/A6.png'),
(4, 'images/airport tribute/A7.png'),
(4, 'images/airport tribute/A8.png'),
(4, 'images/airport tribute/A9.png'),
(5, 'images/poa/P1.png'),
(5, 'images/poa/P2.png'),
(5, 'images/poa/P3.png'),
(5, 'images/poa/P4.png'),
(5, 'images/poa/P5.png'),
(5, 'images/poa/P6.png'),
(5, 'images/poa/P7.png'),
(5, 'images/poa/P8.png'),
(5, 'images/poa/P9.png'),
(5, 'images/poa/P11.png'),
(5, 'images/poa/P12.png'),
(6, 'images/solaris/V1.png'),
(6, 'images/solaris/V2.png'),
(6, 'images/solaris/V3.png'),
(6, 'images/solaris/V4.png'),
(6, 'images/solaris/V5.png'),
(6, 'images/solaris/V6.png'),
(6, 'images/solaris/V7.png'),
(6, 'images/solaris/V8.png'),
(6, 'images/solaris/V9.png'),
(7, 'images/lennox/L2.png'),
(7, 'images/lennox/L3.png'),
(7, 'images/lennox/L4.png'),
(7, 'images/lennox/L5.png'),
(7, 'images/lennox/L6.png'),
(7, 'images/lennox/L7.png'),
(7, 'images/lennox/L8.png'),
(7, 'images/lennox/L9.png'),
(7, 'images/lennox/L10.png'),
(8, 'images/loxwood/LOX1.png'),
(8, 'images/loxwood/LOX2.png'),
(8, 'images/loxwood/LOX3.png'),
(8, 'images/loxwood/LOX4.png'),
(8, 'images/loxwood/LOX5.png'),
(8, 'images/loxwood/LOX6.png'),
(8, 'images/loxwood/LOX7.png'),
(8, 'images/loxwood/LOX8.png'),
(8, 'images/loxwood/LOX9.png'),
(8, 'images/loxwood/LOX10.png'),
(9, 'images/nova/N2.png'),
(9, 'images/nova/N3.png'),
(9, 'images/nova/N4.png'),
(9, 'images/nova/N5.png'),
(9, 'images/nova/N6.png'),
(9, 'images/nova/N7.png'),
(9, 'images/nova/N8.png'),
(9, 'images/nova/N9.png'),
(9, 'images/nova/N10.png'),
(9, 'images/nova/N11.png'),
(9, 'images/nova/N12.png'),
(9, 'images/nova/N13.png'),
(9, 'images/nova/N14.png');

-- payment table to store the invoice
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(255) NOT NULL UNIQUE,
    booking_id INT NOT NULL,
    token VARCHAR(255) NULL,
    amount DECIMAL(12,2) NOT NULL,
    currency CHAR(3) NOT NULL DEFAULT 'GHS',
    status VARCHAR(20) NOT NULL DEFAULT 'PENDING', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id)
);


''