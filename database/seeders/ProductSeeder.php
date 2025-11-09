<?php

namespace Database\Seeders;

use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $products = [
        //     // Start of data from CSV
        //     [
        //         'productId' => 1,
        //         'catId' => 1,
        //         'productName' => 'MAHARAJA CHAIR',
        //         'price' => 8499.00,
        //         'cuttedPrice' => 9500.00,
        //         'description' => 'This is a mesh-back ergonomic office chair designed for comfortable long-hour seating with breathable mesh back and adjustable features.',
        //         'feature' => '1. Comfortable seating – Soft cushioned seat provides long-hour sitting comfort. 2. Breathable mesh back – Allows air circulation, preventing sweat and heat buildup. 3. Adjustable height – Lets you set the chair at a comfortable level for desk work. 4. Mobility – Smooth rolling wheels for easy movement around your workspace. 5. Back support – Curved back design offers lumbar support, helping reduce back strain. 6. Durable base – Chrome or metal base adds strength and stability. 7. Armrests – Support your arms to reduce shoulder tension.',
        //         'thumbnail' => 'frontend/assets/products/MAHARAJA CHAIR.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 2,
        //         'catId' => 1,
        //         'productName' => 'proprietor chair',
        //         'price' => 4499.00,
        //         'cuttedPrice' => 6000.00,
        //         'description' => 'This high-back executive chair is designed for professionals who value comfort and elegance. The thick padding, ergonomic contouring, and premium leather finish make it ideal for office use, meetings, or home workspaces.',
        //         'feature' => '1. Ergonomic Comfort: High backrest supports the spine and neck, reducing fatigue during long sitting hours. 2. Premium Leather Finish: Soft cushioned seat with elegant quilted leather design for both comfort and style. 3. Adjustable Height: Pneumatic gas lift allows easy seat height adjustment. 4. Smooth Mobility: 360° swivel base with durable caster wheels for easy movement. 5. Strong Build: Chrome-finished metal base ensures stability and long life.',
        //         'thumbnail' => 'frontend/assets/products/proprietor chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 3,
        //         'catId' => 1,
        //         'productName' => 'SHET CHAIR',
        //         'price' => 4999.00,
        //         'cuttedPrice' => 5500.00,
        //         'description' => 'This is a premium high-back executive office chair designed for superior comfort and professional appeal.',
        //         'feature' => 'Ergonomic Support: High backrest with lumbar padding ensures proper spine alignment. • Premium Comfort: Soft, cushioned leather upholstery reduces fatigue during long hours. • Adjustable Height: Gas lift mechanism allows smooth seat height adjustment. • Swivel & Mobility: 360° swivel with durable caster wheels for effortless movement. • Stylish Design: Elegant brown leather finish with quilted detailing adds a touch of luxury to any workspace.',
        //         'thumbnail' => 'frontend/assets/products/SHET CHAIR.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 4,
        //         'catId' => 1,
        //         'productName' => 'Owner chair',
        //         'price' => 4499.00,
        //         'cuttedPrice' => 5800.00,
        //         'description' => 'This vibrant red high-back executive chair combines comfort, functionality, and modern style.',
        //         'feature' => 'Ergonomic Design: High backrest supports the spine and neck for comfortable posture. • Premium Comfort: Thick foam cushioning and padded armrests reduce pressure points. • Adjustable Features: Height and tilt adjustments allow a personalized sitting position. • Durable Build: Chrome-finished metal base ensures strength and stability. • Stylish Appearance: Eye-catching red color adds a bold, professional touch to any office or workspace.',
        //         'thumbnail' => 'frontend/assets/products/Owner chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 5,
        //         'catId' => 1,
        //         'productName' => 'Big b chair',
        //         'price' => 4799.00,
        //         'cuttedPrice' => 7000.00,
        //         'description' => 'This stylish executive office chair features a premium dual-tone design in black and tan leatherette, combining elegance with ergonomic comfort.',
        //         'feature' => 'Ergonomic Comfort: High backrest and padded seat support posture and reduce strain. • Premium Finish: Black and tan leatherette adds a professional and modern look. • Adjustable Design: Smooth height and recline control for personalized seating. • Durable Structure: Metal base and smooth-rolling casters ensure strength and easy mobility. • All-Day Support: Thick cushioning and arm padding enhance long-hour sitting comfort',
        //         'thumbnail' => 'frontend/assets/products/Big b chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 6,
        //         'catId' => 1,
        //         'productName' => 'vice president chair',
        //         'price' => 8499.00,
        //         'cuttedPrice' => 10000.00,
        //         'description' => 'This ergonomic mesh office chair is designed for maximum comfort and breathability.',
        //         'feature' => 'Ergonomic Support: Built-in lumbar support and headrest help maintain natural spine alignment. • Breathable Mesh: Promotes airflow to keep you cool during long working hours. • Adjustable Design: Height, tilt, and armrest adjustments for personalized comfort. • Durable Build: Sturdy metal base with smooth caster wheels for stability and mobility. • Modern Look: Sleek, professional design ideal for home or office setups.',
        //         'thumbnail' => 'frontend/assets/products/vice president chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 7,
        //         'catId' => 1,
        //         'productName' => 'Director chair',
        //         'price' => 8199.00,
        //         'cuttedPrice' => 10000.00,
        //         'description' => 'Premium executive office chair designed for leadership positions with superior comfort and professional aesthetics',
        //         'feature' => 'High-back ergonomic design with lumbar support • Premium leather upholstery with quilted detailing • Adjustable height and tilt mechanisms • 360-degree swivel with smooth-rolling casters • Reinforced metal base for stability and durability • Padded armrests for enhanced comfort',
        //         'thumbnail' => 'frontend/assets/products/Director chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 8,
        //         'catId' => 1,
        //         'productName' => 'CEO Chair',
        //         'price' => 4499.00,
        //         'cuttedPrice' => 7000.00,
        //         'description' => 'Executive office chair designed for top-level management with premium features and sophisticated styling',
        //         'feature' => 'Ergonomic high-back design with headrest • Premium leather or leatherette upholstery • Multiple adjustment options (height, tilt, armrests) • 360-degree swivel capability • Durable metal frame with reinforced base • Professional appearance suitable for corporate environments',
        //         'thumbnail' => 'frontend/assets/products/CEO Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 9,
        //         'catId' => 2,
        //         'productName' => 'STAFF CHAIR',
        //         'price' => 4499.00,
        //         'cuttedPrice' => 5500.00,
        //         'description' => 'This mid-back mesh office chair offers a perfect blend of comfort, breathability, and style.',
        //         'feature' => 'Breathable Mesh Back: Keeps you cool and prevents sweat build-up during long hours. • Comfortable Cushion Seat: Soft padding provides support and reduces sitting fatigue. • Height & Tilt Adjustment: Allows customized seating posture for better ergonomics. • Durable Chrome Base: Strong and stylish base ensures long life and stability. • Smooth Mobility: 360° swivel and caster wheels enable easy movement across any workspace.',
        //         'thumbnail' => 'frontend/assets/products/STAFF CHAIR.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 10,
        //         'catId' => 2,
        //         'productName' => 'Bank Staff Chair',
        //         'price' => 4999.00,
        //         'cuttedPrice' => 6500.00,
        //         'description' => 'This ergonomic office chair combines comfort, functionality, and modern design to enhance your workspace experience.',
        //         'feature' => 'Ergonomic Design: Supports natural spine alignment for improved posture. Breathable Mesh Back: Enhances air circulation to prevent sweating and discomfort. Soft Padded Seat: High-density foam seat ensures comfort for extended sitting. Adjustable Height: Pneumatic gas lift allows easy seat height customization. 360° Swivel Function: Smooth-rolling wheels provide easy mobility and flexibility. Comfortable Armrests: Fixed armrests reduce shoulder and wrist strain. Sturdy Base: Durable 5-star metal/plastic base ensures stability and longevity.',
        //         'thumbnail' => 'frontend/assets/products/Bank Staff Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 11,
        //         'catId' => 2,
        //         'productName' => 'Customer chair',
        //         'price' => 3499.00,
        //         'cuttedPrice' => 4500.00,
        //         'description' => 'This is a modern and stylish metal frame chair designed for both comfort and durability.',
        //         'feature' => 'Strong Metal Frame: Built with a sturdy chrome-finished metal frame for long-lasting durability. Comfortable Seating: Padded seat and backrest with soft cushioning provide superior comfort during long sitting hours. Elegant Design: Black upholstery with neat stitching patterns enhances aesthetic appeal. Armrest Support: Smooth wooden armrests with ergonomic design offer additional comfort. Versatile Use: Suitable for offices, conference rooms, visitors areas, or home study rooms. Easy Maintenance: Smooth leatherette surface is easy to clean and maintain. Stable Base: Anti-skid leg tips prevent floor scratches and ensure stability.',
        //         'thumbnail' => 'frontend/assets/products/Customer chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 12,
        //         'catId' => 2,
        //         'productName' => 'Designe chair',
        //         'price' => 3499.00,
        //         'cuttedPrice' => 5000.00,
        //         'description' => 'This is a modern and comfortable visitor chair designed for office, reception, or meeting room use.',
        //         'feature' => 'Durable Build: Strong chrome-plated metal frame provides stability and long-lasting performance. Comfortable Seating: Padded seat and backrest with soft leatherette upholstery for superior comfort. Ergonomic Design: Proper back support and armrests ensure comfortable posture during extended use. Elegant Look: Black cushion with chrome finish gives a professional and modern appearance. Low Maintenance: Easy to clean and resistant to stains or wear. Multipurpose Use: Suitable for offices, reception areas, conference rooms, and waiting lounges.',
        //         'thumbnail' => 'frontend/assets/products/Designe chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 13,
        //         'catId' => 2,
        //         'productName' => 'Confrence chair',
        //         'price' => 4500.00,
        //         'cuttedPrice' => 5500.00,
        //         'description' => 'This is a modern black cushioned chair designed for comfort and durability.',
        //         'feature' => 'Comfortable Design: Soft cushioned seat and backrest provide all-day comfort. Premium Leatherette Upholstery: Smooth, easy-to-clean material resistant to wear and stains. Sturdy Chrome Frame: Rust-resistant metal construction ensures long-lasting durability. Multipurpose Use: Perfect for office visitors, study rooms, conference halls, or reception areas. Ergonomic Armrests: Padded arm supports enhance seating comfort. Low Maintenance: Wipe-clean surface keeps the chair looking new for years. Stable and Balanced: Anti-slip leg caps prevent floor scratches and ensure stability.',
        //         'thumbnail' => 'frontend/assets/products/Confrence chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 14,
        //         'catId' => 2,
        //         'productName' => 'Cinfrss chair',
        //         'price' => 3399.00,
        //         'cuttedPrice' => 5800.00,
        //         'description' => 'This sleek and modern office visitor chair combines comfort, durability, and style.',
        //         'feature' => 'Comfortable Cushioning: Soft, high-density foam seat and backrest for superior comfort. Premium Upholstery: Covered in high-quality leatherette material that is easy to clean and resistant to wear. Sturdy Frame: Built with a robust chrome-finished metal structure for enhanced durability and load-bearing capacity. Padded Armrests: Provides extra comfort and support to arms during extended use. Modern Design: Sleek and professional look suitable for offices, waiting areas, or home workspaces. Low Maintenance: Dust- and stain-resistant surface ensures easy upkeep. Weight Capacity: Can typically support up to 100–120 kg.',
        //         'thumbnail' => 'frontend/assets/products/Cinfrss chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 15,
        //         'catId' => 2,
        //         'productName' => 'Recieption chair',
        //         'price' => 2999.00,
        //         'cuttedPrice' => 5000.00,
        //         'description' => 'This is a metal frame banquet chair designed for multipurpose use in offices, conference halls, restaurants, and events.',
        //         'feature' => 'Sturdy Metal Frame: Built with a strong chrome-plated steel frame for long-lasting support. Comfortable Padding: Soft foam cushioning on the seat and back ensures comfort during extended use. Premium Upholstery: Covered with easy-to-clean leatherette fabric for a professional look. Stackable Design: Chairs can be stacked for easy storage and space optimization. Versatile Use: Suitable for offices, conference halls, restaurants, and events. Modern Aesthetic: Sleek chrome finish with comfortable cushioning for formal and casual settings.',
        //         'thumbnail' => 'frontend/assets/products/Recieption chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 16,
        //         'catId' => 3,
        //         'productName' => 'Cafe chair',
        //         'price' => 2999.00,
        //         'cuttedPrice' => 4400.00,
        //         'description' => 'This elegant bar stool combines modern sophistication with comfort and durability.',
        //         'feature' => 'Stylish Design: Modern gold-finished frame enhances any décor with a touch of glamour. Comfortable Seating: Padded round seat with high-quality leatherette provides long-lasting comfort. Durable Frame: Made from sturdy metal for stability and long-term use. Curved Backrest: Offers ergonomic support for a comfortable sitting experience. Footrest Support: Built-in footrest adds extra comfort and convenience. Versatile Use: Perfect for bars, kitchen counters, restaurants, and lounges. Easy Maintenance: Smooth leatherette surface allows for effortless cleaning.',
        //         'thumbnail' => 'frontend/assets/products/Cafe chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 17,
        //         'catId' => 3,
        //         'productName' => 'Bar 2 chairs',
        //         'price' => 2999.00,
        //         'cuttedPrice' => 5500.00,
        //         'description' => 'This modern adjustable bar stool combines comfort, style, and functionality.',
        //         'feature' => 'Ergonomic Design: Curved seat and backrest provide excellent lumbar support for long sitting sessions. Adjustable Height: Equipped with a gas-lift lever to easily adjust seat height for different counter levels. 360° Swivel Function: Allows free rotation for convenience and flexibility. Sturdy Chrome Base: Polished chrome base ensures stability and durability. Footrest Support: Built-in footrest for enhanced comfort. Premium Upholstery: Soft, easy-to-clean leatherette material adds both luxury and practicality. Stylish Look: Perfect for home bars, kitchen islands, and high counters with its modern, minimalistic appeal.',
        //         'thumbnail' => 'frontend/assets/products/Bar 2 chairs.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 18,
        //         'catId' => 3,
        //         'productName' => 'Chill bar chair',
        //         'price' => 3499.00,
        //         'cuttedPrice' => 6000.00,
        //         'description' => 'This stylish adjustable bar stool chair combines modern design with durable construction.',
        //         'feature' => 'Ergonomic Design: Padded seat and backrest provide comfort for long sitting hours. Height Adjustable: Hydraulic lift mechanism allows smooth height adjustment to suit different counters and tables. 360° Swivel Function: Enables easy movement and accessibility. Sturdy Base: Chrome-plated round base ensures stability and prevents tipping. Built-in Footrest: Offers added support and comfort while seated. Premium Finish: Black leatherette upholstery with stitched detailing for a modern, elegant appearance. Easy to Clean: Smooth, wipeable surfaces ideal for daily use.',
        //         'thumbnail' => 'frontend/assets/products/Chill bar chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 19,
        //         'catId' => 3,
        //         'productName' => 'Bar chair',
        //         'price' => 2999.00,
        //         'cuttedPrice' => 4500.00,
        //         'description' => 'This modern bar stool combines comfort and style with its sleek chrome base and cushioned seat.',
        //         'feature' => 'Key Benefits: • Ergonomic Design: Supports the back and promotes good posture during long hours. • Breathable Mesh Back: Provides excellent airflow to keep you cool and sweat-free. • Comfortable Seating: Soft padded seat reduces pressure and enhances comfort. • Adjustable Height: Gas lift mechanism allows easy height adjustment. • Smooth Movement: 360° swivel and durable wheels for effortless mobility in the workspace.',
        //         'thumbnail' => 'frontend/assets/products/Bar chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 20,
        //         'catId' => 3,
        //         'productName' => 'Drinker chair',
        //         'price' => 3799.00,
        //         'cuttedPrice' => 5650.00,
        //         'description' => 'Modern bar stool with contemporary design featuring pneumatic height adjustment mechanism.',
        //         'feature' => 'Pneumatic gas lift mechanism for easy height adjustment • Modern contemporary aesthetic design • Suitable for home bars and commercial settings • Easy to adjust for different counter heights • Durable construction for long-term use',
        //         'thumbnail' => 'frontend/assets/products/Drinker chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 21,
        //         'catId' => 3,
        //         'productName' => 'Round Stool',
        //         'price' => 1999.00,
        //         'cuttedPrice' => 3500.00,
        //         'description' => 'Backless bar stool with comfortable padded seating and chrome metal frame.',
        //         'feature' => 'Space Saving: Backless design allows sliding under counters • Durability: Chrome metal frame resistant to dings • Easy Maintenance: Faux leather/vinyl seats spill-resistant • Versatility: Round shape allows sitting from any angle • Aesthetic Appeal: Bright upholstery with chrome creates retro/modern look • Value: Affordable fixed-height design • Uniform Look: Consistent seating line along counters',
        //         'thumbnail' => 'frontend/assets/products/Round Stool.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 22,
        //         'catId' => 3,
        //         'productName' => 'Bar Stool',
        //         'price' => 2499.00,
        //         'cuttedPrice' => 4000.00,
        //         'description' => 'Contemporary bar stool with artistic stacked design, featuring red cushioned seats.',
        //         'feature' => 'Material: Sturdy metal frame with chrome finish. Seat: Soft, round, red cushioned seat for comfort. Design: Modern industrial look with geometric structure. Functionality: Stackable for easy storage and artistic display. Base: Circular base for stability and support. Usage: Ideal for bars, cafes, or contemporary interiors.',
        //         'thumbnail' => 'frontend/assets/products/Bar Stool.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 23,
        //         'catId' => 4,
        //         'productName' => 'Taj chair',
        //         'price' => 2499.00,
        //         'cuttedPrice' => 4000.00,
        //         'description' => 'This is a stylish and durable metal chair designed for both home and commercial use.',
        //         'feature' => 'Strong and sturdy metal frame for long-lasting durability. Comfortable padded seat with red fabric upholstery. Elegant black powder-coated finish for rust resistance. Stackable design for easy storage and space saving. Versatile use in dining areas, restaurants, events, and offices. Lightweight and easy to move. Rubber foot caps protect floors from scratches.',
        //         'thumbnail' => 'frontend/assets/products/Taj chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 24,
        //         'catId' => 4,
        //         'productName' => 'Garden chair',
        //         'price' => 2999.00,
        //         'cuttedPrice' => 4000.00,
        //         'description' => 'This is a classic metal dining chair with a comfortable cushioned seat, ideal for dining rooms, kitchens, or cafes.',
        //         'feature' => 'Durable Metal Frame: Constructed with high-quality steel for strength and stability. Comfortable Seating: Soft, padded seat cushion for extended seating comfort. Classic Design: Timeless and versatile design that blends with various decor styles. Stackable: Chairs can be stacked for efficient storage when not in use. Powder-Coated Finish: Provides resistance against rust and scratches for longevity. Floor Protection: Equipped with protective foot caps to prevent floor damage. Easy Maintenance: Simple design and materials are easy to clean and maintain.',
        //         'thumbnail' => 'frontend/assets/products/Garden chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 25,
        //         'catId' => 4,
        //         'productName' => 'Normal dining chair',
        //         'price' => 2999.00,
        //         'cuttedPrice' => 4500.00,
        //         'description' => 'This is an elegant metal chair designed for formal dining, banquets, or hotel use.',
        //         'feature' => 'Sturdy Metal Frame: High-quality steel construction with a metallic finish for durability. Comfortable Upholstery: Padded seat and backrest with premium fabric for luxurious comfort. Elegant Design: Ornate back pattern and sleek finish suitable for formal settings. Stackable: Designed to be stackable for easy transport and space-saving storage. Floor Protection: Rubberized foot caps prevent scratching and scuffing of floors. Versatile Use: Ideal for hotels, wedding halls, banquet rooms, and fine dining restaurants. Low Maintenance: Durable finish and upholstery are easy to clean and maintain.',
        //         'thumbnail' => 'frontend/assets/products/Normal dining chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 26,
        //         'catId' => 4,
        //         'productName' => 'Garden chair',
        //         'price' => 1999.00,
        //         'cuttedPrice' => 3500.00,
        //         'description' => 'This is a durable, lightweight, and weather-resistant plastic chair suitable for indoor and outdoor use.',
        //         'feature' => 'Durable Plastic Construction: Made from high-grade, UV-stabilized plastic for long-lasting use. Weather Resistant: Ideal for outdoor use, resistant to rain, sun, and moisture. Stackable Design: Allows for easy storage and saves space. Easy to Clean: Simple, wipe-clean surface for effortless maintenance. Lightweight: Easy to move and rearrange. Versatile Use: Perfect for gardens, patios, balconies, cafes, and additional indoor seating. Comfortable Backrest: Ergonomic back design provides adequate support.',
        //         'thumbnail' => 'frontend/assets/products/Garden chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 27,
        //         'catId' => 5,
        //         'productName' => 'Study Chair',
        //         'price' => 3499.00,
        //         'cuttedPrice' => 4500.00,
        //         'description' => 'This ergonomic mesh study chair is designed for students and professionals, offering comfort during long study or work sessions.',
        //         'feature' => 'Ergonomic Design: Mid-back support promotes good posture, reducing strain. Breathable Mesh Back: Allows air circulation, keeping you cool and comfortable. Adjustable Height: Gas lift mechanism for customized seating level. Swivel & Mobility: 360° swivel and smooth caster wheels for easy movement. Padded Seat: High-density foam cushion ensures comfortable sitting. Durable Base: Sturdy metal or nylon base provides stability. Compact Size: Ideal for home study rooms or small office spaces.',
        //         'thumbnail' => 'frontend/assets/products/Study Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 28,
        //         'catId' => 5,
        //         'productName' => 'Student Chair',
        //         'price' => 3499.00,
        //         'cuttedPrice' => 4500.00,
        //         'description' => 'This modern and compact study chair is perfect for students and home office users, featuring a padded seat and backrest.',
        //         'feature' => 'Comfortable Seating: Soft padded seat and back for extended use. Adjustable Height: Gas-lift mechanism allows easy customization of seat height. 360° Swivel: Full swivel function for convenience and flexibility. Smooth Mobility: Caster wheels for easy movement across the floor. Durable Structure: Strong metal or nylon base for stability and longevity. Space-Saving: Compact design fits well into smaller study areas. Easy Assembly: Simple to put together with minimal tools.',
        //         'thumbnail' => 'frontend/assets/products/Student Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 29,
        //         'catId' => 6,
        //         'productName' => 'Folding Stool',
        //         'price' => 1499.00,
        //         'cuttedPrice' => 2500.00,
        //         'description' => 'This is a versatile, foldable padded stool designed for easy storage and portable seating.',
        //         'feature' => 'Foldable Design: Effortlessly folds flat for space-saving storage and portability. Padded Seat: Soft cushion ensures comfortable seating for short or long periods. Durable Frame: Built with a strong metal frame for stability and longevity. Multipurpose Use: Ideal for extra seating in homes, offices, events, and outdoor activities. Lightweight: Easy to carry and transport. Anti-Skid: Rubber feet prevent slipping and protect floors from scratches. Easy to Clean: Simple surface is easy to wipe down and maintain.',
        //         'thumbnail' => 'frontend/assets/products/Folding Stool.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 30,
        //         'catId' => 6,
        //         'productName' => 'Folding Stool (2 kg)',
        //         'price' => 1199.00,
        //         'cuttedPrice' => 2000.00,
        //         'description' => 'This is a lightweight and easily portable folding stool with a comfortable cushioned seat.',
        //         'feature' => 'Lightweight & Portable: Weighs approximately 2 kg, making it easy to carry. Foldable Design: Folds flat for minimal storage space. Comfortable Seating: Soft padded seat for temporary or extended sitting. Sturdy Metal Frame: Provides reliable support and durability. Versatile: Perfect for extra seating at home, camping, picnics, or small events. Protective Feet: Fitted with foot caps to prevent floor damage. Low Maintenance: Easy to wipe clean and maintain.',
        //         'thumbnail' => 'frontend/assets/products/Folding Stool (2 kg).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 31,
        //         'catId' => 7,
        //         'productName' => 'Waiting Chair 3 Seater',
        //         'price' => 5999.00,
        //         'cuttedPrice' => 8000.00,
        //         'description' => 'A heavy-duty, three-seater metal waiting bench designed for high-traffic public areas.',
        //         'feature' => '3-Seater Configuration: Comfortably accommodates three individuals. Durable Construction: Built with a robust metal frame for strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seater chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 32,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seaters chair (18 kg )',
        //         'price' => 4799.00,
        //         'cuttedPrice' => 7500.00,
        //         'description' => 'This is a reliable and sturdy three-seater metal waiting chair, perfect for public areas like hospitals, airports, and offices.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seaters chair (18 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 33,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seaters chair (20 kg )',
        //         'price' => 4999.00,
        //         'cuttedPrice' => 8500.00,
        //         'description' => 'A robust and durable three-seater metal waiting chair, built to withstand heavy usage in public environments.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seaters chair (20 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 34,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seaters chair (22 kg )',
        //         'price' => 5299.00,
        //         'cuttedPrice' => 9000.00,
        //         'description' => 'High-quality three-seater metal waiting chair with extra-heavy-duty construction for superior durability.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seaters chair (22 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 35,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seater chair (16 kg )',
        //         'price' => 4599.00,
        //         'cuttedPrice' => 7800.00,
        //         'description' => 'A sturdy and dependable three-seater metal waiting chair designed for various public settings.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seater chair (16 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 36,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seater chair (17 kg )',
        //         'price' => 4699.00,
        //         'cuttedPrice' => 7900.00,
        //         'description' => 'A strong and practical three-seater metal waiting chair suitable for busy public areas.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seater chair (17 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 37,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seaters chair (14 kg )',
        //         'price' => 4499.00,
        //         'cuttedPrice' => 8000.00,
        //         'description' => 'This is a three-seater metal waiting chair, designed for use in offices, hospitals, and public spaces.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seaters chair (14 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'productId' => 38,
        //         'catId' => 7,
        //         'productName' => 'Public 3 seaters chair (14 kg )',
        //         'price' => 4499.00,
        //         'cuttedPrice' => 8000.00,
        //         'description' => 'This is a three-seater metal waiting chair, designed for use in offices, hospitals, and public spaces.',
        //         'feature' => '3-Seater Design: Accommodates three people comfortably. Durable Metal Frame: Made from high-quality steel for long-lasting strength and stability. Powder-Coated Finish: Rust-resistant and easy to clean, maintaining a polished look. Ergonomic Backrest & Seat: Provides proper posture support for extended sitting. Fixed Armrests: Smooth curved arms for added comfort and support. Sturdy Leg Base: Equipped with anti-slip foot caps for stability and floor protection. Low Maintenance: Easy to clean and suitable for heavy public use. Color: Typically available in black or metallic finish for a professional appearance.',
        //         'thumbnail' => 'frontend/assets/products/Public 3 seaters chair (14 kg ).jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ]
        //     // End of data from CSV
        // ];

        // // Chunking the inserts for better performance on large datasets
        // foreach (array_chunk($products, 100) as $chunk) {
        //     DB::table('products')->insert($chunk);
        // }



        $path = database_path('seeders/data/products.csv');
        if (!File::exists($path)) {
            $this->command->error("File not found: $path");
            return;
        }

        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        foreach ($data as $row) {
            $product = array_combine($header, $row);

            DB::table('products')->insert([
                'productId' => $product['productId'] ?? null,
                'catId' => $product['catId'] ?? null,
                'productName' => $product['productName'] ?? null,
                'price' => $product['price'] ?? null,
                'cuttedPrice' => $product['cuttedPrice'] ?? null,
                'description' => $product['description'] ?? null,
                'feature' => $product['feature'] ?? null,
                'thumbnail' => $product['thumbnail'] ?? null,
                'isVisible' => $product['isVisible'] ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Products table seeded successfully.');

    }
}