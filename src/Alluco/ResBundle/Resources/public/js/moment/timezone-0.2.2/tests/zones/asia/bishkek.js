"use strict";

var helpers = require("../../helpers/helpers");

exports["Asia/Bishkek"] = {
	"1924" : helpers.makeTestYear("Asia/Bishkek", [
		["1924-05-01T19:01:35+00:00", "23:59:59", "LMT", -17904 / 60],
		["1924-05-01T19:01:36+00:00", "00:01:36", "FRUT", -300]
	]),

	"1930" : helpers.makeTestYear("Asia/Bishkek", [
		["1930-06-20T18:59:59+00:00", "23:59:59", "FRUT", -300],
		["1930-06-20T19:00:00+00:00", "01:00:00", "FRUT", -360]
	]),

	"1981" : helpers.makeTestYear("Asia/Bishkek", [
		["1981-03-31T17:59:59+00:00", "23:59:59", "FRUT", -360],
		["1981-03-31T18:00:00+00:00", "01:00:00", "FRUST", -420],
		["1981-09-30T16:59:59+00:00", "23:59:59", "FRUST", -420],
		["1981-09-30T17:00:00+00:00", "23:00:00", "FRUT", -360]
	]),

	"1982" : helpers.makeTestYear("Asia/Bishkek", [
		["1982-03-31T17:59:59+00:00", "23:59:59", "FRUT", -360],
		["1982-03-31T18:00:00+00:00", "01:00:00", "FRUST", -420],
		["1982-09-30T16:59:59+00:00", "23:59:59", "FRUST", -420],
		["1982-09-30T17:00:00+00:00", "23:00:00", "FRUT", -360]
	]),

	"1983" : helpers.makeTestYear("Asia/Bishkek", [
		["1983-03-31T17:59:59+00:00", "23:59:59", "FRUT", -360],
		["1983-03-31T18:00:00+00:00", "01:00:00", "FRUST", -420],
		["1983-09-30T16:59:59+00:00", "23:59:59", "FRUST", -420],
		["1983-09-30T17:00:00+00:00", "23:00:00", "FRUT", -360]
	]),

	"1984" : helpers.makeTestYear("Asia/Bishkek", [
		["1984-03-31T17:59:59+00:00", "23:59:59", "FRUT", -360],
		["1984-03-31T18:00:00+00:00", "01:00:00", "FRUST", -420],
		["1984-09-29T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1984-09-29T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1985" : helpers.makeTestYear("Asia/Bishkek", [
		["1985-03-30T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1985-03-30T20:00:00+00:00", "03:00:00", "FRUST", -420],
		["1985-09-28T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1985-09-28T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1986" : helpers.makeTestYear("Asia/Bishkek", [
		["1986-03-29T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1986-03-29T20:00:00+00:00", "03:00:00", "FRUST", -420],
		["1986-09-27T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1986-09-27T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1987" : helpers.makeTestYear("Asia/Bishkek", [
		["1987-03-28T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1987-03-28T20:00:00+00:00", "03:00:00", "FRUST", -420],
		["1987-09-26T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1987-09-26T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1988" : helpers.makeTestYear("Asia/Bishkek", [
		["1988-03-26T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1988-03-26T20:00:00+00:00", "03:00:00", "FRUST", -420],
		["1988-09-24T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1988-09-24T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1989" : helpers.makeTestYear("Asia/Bishkek", [
		["1989-03-25T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1989-03-25T20:00:00+00:00", "03:00:00", "FRUST", -420],
		["1989-09-23T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1989-09-23T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1990" : helpers.makeTestYear("Asia/Bishkek", [
		["1990-03-24T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1990-03-24T20:00:00+00:00", "03:00:00", "FRUST", -420],
		["1990-09-29T19:59:59+00:00", "02:59:59", "FRUST", -420],
		["1990-09-29T20:00:00+00:00", "02:00:00", "FRUT", -360]
	]),

	"1991" : helpers.makeTestYear("Asia/Bishkek", [
		["1991-03-30T19:59:59+00:00", "01:59:59", "FRUT", -360],
		["1991-03-30T20:00:00+00:00", "02:00:00", "FRUST", -360],
		["1991-08-30T19:59:59+00:00", "01:59:59", "FRUST", -360],
		["1991-08-30T20:00:00+00:00", "01:00:00", "KGT", -300]
	]),

	"1992" : helpers.makeTestYear("Asia/Bishkek", [
		["1992-04-11T18:59:59+00:00", "23:59:59", "KGT", -300],
		["1992-04-11T19:00:00+00:00", "01:00:00", "KGST", -360],
		["1992-09-26T17:59:59+00:00", "23:59:59", "KGST", -360],
		["1992-09-26T18:00:00+00:00", "23:00:00", "KGT", -300]
	]),

	"1993" : helpers.makeTestYear("Asia/Bishkek", [
		["1993-04-10T18:59:59+00:00", "23:59:59", "KGT", -300],
		["1993-04-10T19:00:00+00:00", "01:00:00", "KGST", -360],
		["1993-09-25T17:59:59+00:00", "23:59:59", "KGST", -360],
		["1993-09-25T18:00:00+00:00", "23:00:00", "KGT", -300]
	]),

	"1994" : helpers.makeTestYear("Asia/Bishkek", [
		["1994-04-09T18:59:59+00:00", "23:59:59", "KGT", -300],
		["1994-04-09T19:00:00+00:00", "01:00:00", "KGST", -360],
		["1994-09-24T17:59:59+00:00", "23:59:59", "KGST", -360],
		["1994-09-24T18:00:00+00:00", "23:00:00", "KGT", -300]
	]),

	"1995" : helpers.makeTestYear("Asia/Bishkek", [
		["1995-04-08T18:59:59+00:00", "23:59:59", "KGT", -300],
		["1995-04-08T19:00:00+00:00", "01:00:00", "KGST", -360],
		["1995-09-23T17:59:59+00:00", "23:59:59", "KGST", -360],
		["1995-09-23T18:00:00+00:00", "23:00:00", "KGT", -300]
	]),

	"1996" : helpers.makeTestYear("Asia/Bishkek", [
		["1996-04-06T18:59:59+00:00", "23:59:59", "KGT", -300],
		["1996-04-06T19:00:00+00:00", "01:00:00", "KGST", -360],
		["1996-09-28T17:59:59+00:00", "23:59:59", "KGST", -360],
		["1996-09-28T18:00:00+00:00", "23:00:00", "KGT", -300]
	]),

	"1997" : helpers.makeTestYear("Asia/Bishkek", [
		["1997-03-29T21:29:59+00:00", "02:29:59", "KGT", -300],
		["1997-03-29T21:30:00+00:00", "03:30:00", "KGST", -360],
		["1997-10-25T20:29:59+00:00", "02:29:59", "KGST", -360],
		["1997-10-25T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"1998" : helpers.makeTestYear("Asia/Bishkek", [
		["1998-03-28T21:29:59+00:00", "02:29:59", "KGT", -300],
		["1998-03-28T21:30:00+00:00", "03:30:00", "KGST", -360],
		["1998-10-24T20:29:59+00:00", "02:29:59", "KGST", -360],
		["1998-10-24T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"1999" : helpers.makeTestYear("Asia/Bishkek", [
		["1999-03-27T21:29:59+00:00", "02:29:59", "KGT", -300],
		["1999-03-27T21:30:00+00:00", "03:30:00", "KGST", -360],
		["1999-10-30T20:29:59+00:00", "02:29:59", "KGST", -360],
		["1999-10-30T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"2000" : helpers.makeTestYear("Asia/Bishkek", [
		["2000-03-25T21:29:59+00:00", "02:29:59", "KGT", -300],
		["2000-03-25T21:30:00+00:00", "03:30:00", "KGST", -360],
		["2000-10-28T20:29:59+00:00", "02:29:59", "KGST", -360],
		["2000-10-28T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"2001" : helpers.makeTestYear("Asia/Bishkek", [
		["2001-03-24T21:29:59+00:00", "02:29:59", "KGT", -300],
		["2001-03-24T21:30:00+00:00", "03:30:00", "KGST", -360],
		["2001-10-27T20:29:59+00:00", "02:29:59", "KGST", -360],
		["2001-10-27T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"2002" : helpers.makeTestYear("Asia/Bishkek", [
		["2002-03-30T21:29:59+00:00", "02:29:59", "KGT", -300],
		["2002-03-30T21:30:00+00:00", "03:30:00", "KGST", -360],
		["2002-10-26T20:29:59+00:00", "02:29:59", "KGST", -360],
		["2002-10-26T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"2003" : helpers.makeTestYear("Asia/Bishkek", [
		["2003-03-29T21:29:59+00:00", "02:29:59", "KGT", -300],
		["2003-03-29T21:30:00+00:00", "03:30:00", "KGST", -360],
		["2003-10-25T20:29:59+00:00", "02:29:59", "KGST", -360],
		["2003-10-25T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"2004" : helpers.makeTestYear("Asia/Bishkek", [
		["2004-03-27T21:29:59+00:00", "02:29:59", "KGT", -300],
		["2004-03-27T21:30:00+00:00", "03:30:00", "KGST", -360],
		["2004-10-30T20:29:59+00:00", "02:29:59", "KGST", -360],
		["2004-10-30T20:30:00+00:00", "01:30:00", "KGT", -300]
	]),

	"2005" : helpers.makeTestYear("Asia/Bishkek", [
		["2005-03-26T21:29:59+00:00", "02:29:59", "KGT", -300],
		["2005-03-26T21:30:00+00:00", "03:30:00", "KGST", -360],
		["2005-08-11T17:59:59+00:00", "23:59:59", "KGST", -360],
		["2005-08-11T18:00:00+00:00", "00:00:00", "KGT", -360]
	])
};