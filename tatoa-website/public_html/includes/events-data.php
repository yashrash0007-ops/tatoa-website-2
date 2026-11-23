<?php
/**
 * Event catalog for Events & Training (Module 8).
 * Sample/placeholder events for demonstration. Once the Admin
 * Dashboard can manage content, TATOA staff will edit these directly
 * instead of this array.
 */
function get_events(): array {
    return [
        [
            "id" => "ev1",
            "title" => "TATOA Annual General Meeting",
            "date" => "2026-10-14",
            "location" => "Dar es Salaam",
            "description" => "Annual meeting for all members: elections, reports and industry outlook.",
        ],
        [
            "id" => "ev2",
            "title" => "Cross-Border Documentation Workshop",
            "date" => "2026-09-25",
            "location" => "Mbeya",
            "description" => "Practical workshop on TAZARA corridor customs and border documentation.",
        ],
        [
            "id" => "ev3",
            "title" => "Fleet Safety & Compliance Training",
            "date" => "2026-11-05",
            "location" => "Arusha",
            "description" => "Axle-load compliance, driver safety and LATRA inspection readiness.",
        ],
    ];
}

function get_event(string $id): ?array {
    foreach (get_events() as $ev) {
        if ($ev['id'] === $id) return $ev;
    }
    return null;
}
