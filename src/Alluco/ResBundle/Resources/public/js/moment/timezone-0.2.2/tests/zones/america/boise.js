"use strict";

var helpers = require("../../helpers/helpers");

exports["America/Boise"] = {
	"1918" : helpers.makeTestYear("America/Boise", [
		["1918-03-31T09:59:59+00:00", "01:59:59", "PST", 480],
		["1918-03-31T10:00:00+00:00", "03:00:00", "PDT", 420],
		["1918-10-27T08:59:59+00:00", "01:59:59", "PDT", 420],
		["1918-10-27T09:00:00+00:00", "01:00:00", "PST", 480]
	]),

	"1919" : helpers.makeTestYear("America/Boise", [
		["1919-03-30T09:59:59+00:00", "01:59:59", "PST", 480],
		["1919-03-30T10:00:00+00:00", "03:00:00", "PDT", 420],
		["1919-10-26T08:59:59+00:00", "01:59:59", "PDT", 420],
		["1919-10-26T09:00:00+00:00", "01:00:00", "PST", 480]
	]),

	"1923" : helpers.makeTestYear("America/Boise", [
		["1923-05-13T09:59:59+00:00", "01:59:59", "PST", 480],
		["1923-05-13T10:00:00+00:00", "03:00:00", "MST", 420]
	]),

	"1942" : helpers.makeTestYear("America/Boise", [
		["1942-02-09T08:59:59+00:00", "01:59:59", "MST", 420],
		["1942-02-09T09:00:00+00:00", "03:00:00", "MWT", 360]
	]),

	"1945" : helpers.makeTestYear("America/Boise", [
		["1945-08-14T22:59:59+00:00", "16:59:59", "MWT", 360],
		["1945-08-14T23:00:00+00:00", "17:00:00", "MPT", 360],
		["1945-09-30T07:59:59+00:00", "01:59:59", "MPT", 360],
		["1945-09-30T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1967" : helpers.makeTestYear("America/Boise", [
		["1967-04-30T08:59:59+00:00", "01:59:59", "MST", 420],
		["1967-04-30T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1967-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1967-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1968" : helpers.makeTestYear("America/Boise", [
		["1968-04-28T08:59:59+00:00", "01:59:59", "MST", 420],
		["1968-04-28T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1968-10-27T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1968-10-27T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1969" : helpers.makeTestYear("America/Boise", [
		["1969-04-27T08:59:59+00:00", "01:59:59", "MST", 420],
		["1969-04-27T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1969-10-26T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1969-10-26T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1970" : helpers.makeTestYear("America/Boise", [
		["1970-04-26T08:59:59+00:00", "01:59:59", "MST", 420],
		["1970-04-26T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1970-10-25T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1970-10-25T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1971" : helpers.makeTestYear("America/Boise", [
		["1971-04-25T08:59:59+00:00", "01:59:59", "MST", 420],
		["1971-04-25T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1971-10-31T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1971-10-31T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1972" : helpers.makeTestYear("America/Boise", [
		["1972-04-30T08:59:59+00:00", "01:59:59", "MST", 420],
		["1972-04-30T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1972-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1972-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1973" : helpers.makeTestYear("America/Boise", [
		["1973-04-29T08:59:59+00:00", "01:59:59", "MST", 420],
		["1973-04-29T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1973-10-28T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1973-10-28T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1974" : helpers.makeTestYear("America/Boise", [
		["1974-02-03T08:59:59+00:00", "01:59:59", "MST", 420],
		["1974-02-03T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1974-10-27T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1974-10-27T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1975" : helpers.makeTestYear("America/Boise", [
		["1975-02-23T08:59:59+00:00", "01:59:59", "MST", 420],
		["1975-02-23T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1975-10-26T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1975-10-26T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1976" : helpers.makeTestYear("America/Boise", [
		["1976-04-25T08:59:59+00:00", "01:59:59", "MST", 420],
		["1976-04-25T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1976-10-31T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1976-10-31T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1977" : helpers.makeTestYear("America/Boise", [
		["1977-04-24T08:59:59+00:00", "01:59:59", "MST", 420],
		["1977-04-24T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1977-10-30T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1977-10-30T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1978" : helpers.makeTestYear("America/Boise", [
		["1978-04-30T08:59:59+00:00", "01:59:59", "MST", 420],
		["1978-04-30T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1978-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1978-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1979" : helpers.makeTestYear("America/Boise", [
		["1979-04-29T08:59:59+00:00", "01:59:59", "MST", 420],
		["1979-04-29T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1979-10-28T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1979-10-28T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1980" : helpers.makeTestYear("America/Boise", [
		["1980-04-27T08:59:59+00:00", "01:59:59", "MST", 420],
		["1980-04-27T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1980-10-26T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1980-10-26T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1981" : helpers.makeTestYear("America/Boise", [
		["1981-04-26T08:59:59+00:00", "01:59:59", "MST", 420],
		["1981-04-26T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1981-10-25T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1981-10-25T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1982" : helpers.makeTestYear("America/Boise", [
		["1982-04-25T08:59:59+00:00", "01:59:59", "MST", 420],
		["1982-04-25T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1982-10-31T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1982-10-31T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1983" : helpers.makeTestYear("America/Boise", [
		["1983-04-24T08:59:59+00:00", "01:59:59", "MST", 420],
		["1983-04-24T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1983-10-30T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1983-10-30T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1984" : helpers.makeTestYear("America/Boise", [
		["1984-04-29T08:59:59+00:00", "01:59:59", "MST", 420],
		["1984-04-29T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1984-10-28T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1984-10-28T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1985" : helpers.makeTestYear("America/Boise", [
		["1985-04-28T08:59:59+00:00", "01:59:59", "MST", 420],
		["1985-04-28T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1985-10-27T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1985-10-27T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1986" : helpers.makeTestYear("America/Boise", [
		["1986-04-27T08:59:59+00:00", "01:59:59", "MST", 420],
		["1986-04-27T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1986-10-26T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1986-10-26T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1987" : helpers.makeTestYear("America/Boise", [
		["1987-04-05T08:59:59+00:00", "01:59:59", "MST", 420],
		["1987-04-05T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1987-10-25T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1987-10-25T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1988" : helpers.makeTestYear("America/Boise", [
		["1988-04-03T08:59:59+00:00", "01:59:59", "MST", 420],
		["1988-04-03T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1988-10-30T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1988-10-30T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1989" : helpers.makeTestYear("America/Boise", [
		["1989-04-02T08:59:59+00:00", "01:59:59", "MST", 420],
		["1989-04-02T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1989-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1989-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1990" : helpers.makeTestYear("America/Boise", [
		["1990-04-01T08:59:59+00:00", "01:59:59", "MST", 420],
		["1990-04-01T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1990-10-28T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1990-10-28T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1991" : helpers.makeTestYear("America/Boise", [
		["1991-04-07T08:59:59+00:00", "01:59:59", "MST", 420],
		["1991-04-07T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1991-10-27T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1991-10-27T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1992" : helpers.makeTestYear("America/Boise", [
		["1992-04-05T08:59:59+00:00", "01:59:59", "MST", 420],
		["1992-04-05T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1992-10-25T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1992-10-25T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1993" : helpers.makeTestYear("America/Boise", [
		["1993-04-04T08:59:59+00:00", "01:59:59", "MST", 420],
		["1993-04-04T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1993-10-31T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1993-10-31T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1994" : helpers.makeTestYear("America/Boise", [
		["1994-04-03T08:59:59+00:00", "01:59:59", "MST", 420],
		["1994-04-03T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1994-10-30T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1994-10-30T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1995" : helpers.makeTestYear("America/Boise", [
		["1995-04-02T08:59:59+00:00", "01:59:59", "MST", 420],
		["1995-04-02T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1995-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1995-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1996" : helpers.makeTestYear("America/Boise", [
		["1996-04-07T08:59:59+00:00", "01:59:59", "MST", 420],
		["1996-04-07T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1996-10-27T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1996-10-27T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1997" : helpers.makeTestYear("America/Boise", [
		["1997-04-06T08:59:59+00:00", "01:59:59", "MST", 420],
		["1997-04-06T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1997-10-26T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1997-10-26T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1998" : helpers.makeTestYear("America/Boise", [
		["1998-04-05T08:59:59+00:00", "01:59:59", "MST", 420],
		["1998-04-05T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1998-10-25T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1998-10-25T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"1999" : helpers.makeTestYear("America/Boise", [
		["1999-04-04T08:59:59+00:00", "01:59:59", "MST", 420],
		["1999-04-04T09:00:00+00:00", "03:00:00", "MDT", 360],
		["1999-10-31T07:59:59+00:00", "01:59:59", "MDT", 360],
		["1999-10-31T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2000" : helpers.makeTestYear("America/Boise", [
		["2000-04-02T08:59:59+00:00", "01:59:59", "MST", 420],
		["2000-04-02T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2000-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2000-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2001" : helpers.makeTestYear("America/Boise", [
		["2001-04-01T08:59:59+00:00", "01:59:59", "MST", 420],
		["2001-04-01T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2001-10-28T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2001-10-28T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2002" : helpers.makeTestYear("America/Boise", [
		["2002-04-07T08:59:59+00:00", "01:59:59", "MST", 420],
		["2002-04-07T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2002-10-27T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2002-10-27T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2003" : helpers.makeTestYear("America/Boise", [
		["2003-04-06T08:59:59+00:00", "01:59:59", "MST", 420],
		["2003-04-06T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2003-10-26T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2003-10-26T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2004" : helpers.makeTestYear("America/Boise", [
		["2004-04-04T08:59:59+00:00", "01:59:59", "MST", 420],
		["2004-04-04T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2004-10-31T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2004-10-31T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2005" : helpers.makeTestYear("America/Boise", [
		["2005-04-03T08:59:59+00:00", "01:59:59", "MST", 420],
		["2005-04-03T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2005-10-30T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2005-10-30T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2006" : helpers.makeTestYear("America/Boise", [
		["2006-04-02T08:59:59+00:00", "01:59:59", "MST", 420],
		["2006-04-02T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2006-10-29T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2006-10-29T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2007" : helpers.makeTestYear("America/Boise", [
		["2007-03-11T08:59:59+00:00", "01:59:59", "MST", 420],
		["2007-03-11T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2007-11-04T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2007-11-04T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2008" : helpers.makeTestYear("America/Boise", [
		["2008-03-09T08:59:59+00:00", "01:59:59", "MST", 420],
		["2008-03-09T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2008-11-02T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2008-11-02T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2009" : helpers.makeTestYear("America/Boise", [
		["2009-03-08T08:59:59+00:00", "01:59:59", "MST", 420],
		["2009-03-08T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2009-11-01T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2009-11-01T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2010" : helpers.makeTestYear("America/Boise", [
		["2010-03-14T08:59:59+00:00", "01:59:59", "MST", 420],
		["2010-03-14T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2010-11-07T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2010-11-07T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2011" : helpers.makeTestYear("America/Boise", [
		["2011-03-13T08:59:59+00:00", "01:59:59", "MST", 420],
		["2011-03-13T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2011-11-06T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2011-11-06T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2012" : helpers.makeTestYear("America/Boise", [
		["2012-03-11T08:59:59+00:00", "01:59:59", "MST", 420],
		["2012-03-11T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2012-11-04T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2012-11-04T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2013" : helpers.makeTestYear("America/Boise", [
		["2013-03-10T08:59:59+00:00", "01:59:59", "MST", 420],
		["2013-03-10T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2013-11-03T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2013-11-03T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2014" : helpers.makeTestYear("America/Boise", [
		["2014-03-09T08:59:59+00:00", "01:59:59", "MST", 420],
		["2014-03-09T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2014-11-02T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2014-11-02T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2015" : helpers.makeTestYear("America/Boise", [
		["2015-03-08T08:59:59+00:00", "01:59:59", "MST", 420],
		["2015-03-08T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2015-11-01T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2015-11-01T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2016" : helpers.makeTestYear("America/Boise", [
		["2016-03-13T08:59:59+00:00", "01:59:59", "MST", 420],
		["2016-03-13T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2016-11-06T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2016-11-06T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2017" : helpers.makeTestYear("America/Boise", [
		["2017-03-12T08:59:59+00:00", "01:59:59", "MST", 420],
		["2017-03-12T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2017-11-05T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2017-11-05T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2018" : helpers.makeTestYear("America/Boise", [
		["2018-03-11T08:59:59+00:00", "01:59:59", "MST", 420],
		["2018-03-11T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2018-11-04T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2018-11-04T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2019" : helpers.makeTestYear("America/Boise", [
		["2019-03-10T08:59:59+00:00", "01:59:59", "MST", 420],
		["2019-03-10T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2019-11-03T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2019-11-03T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2020" : helpers.makeTestYear("America/Boise", [
		["2020-03-08T08:59:59+00:00", "01:59:59", "MST", 420],
		["2020-03-08T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2020-11-01T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2020-11-01T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2021" : helpers.makeTestYear("America/Boise", [
		["2021-03-14T08:59:59+00:00", "01:59:59", "MST", 420],
		["2021-03-14T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2021-11-07T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2021-11-07T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2022" : helpers.makeTestYear("America/Boise", [
		["2022-03-13T08:59:59+00:00", "01:59:59", "MST", 420],
		["2022-03-13T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2022-11-06T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2022-11-06T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2023" : helpers.makeTestYear("America/Boise", [
		["2023-03-12T08:59:59+00:00", "01:59:59", "MST", 420],
		["2023-03-12T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2023-11-05T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2023-11-05T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2024" : helpers.makeTestYear("America/Boise", [
		["2024-03-10T08:59:59+00:00", "01:59:59", "MST", 420],
		["2024-03-10T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2024-11-03T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2024-11-03T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2025" : helpers.makeTestYear("America/Boise", [
		["2025-03-09T08:59:59+00:00", "01:59:59", "MST", 420],
		["2025-03-09T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2025-11-02T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2025-11-02T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2026" : helpers.makeTestYear("America/Boise", [
		["2026-03-08T08:59:59+00:00", "01:59:59", "MST", 420],
		["2026-03-08T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2026-11-01T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2026-11-01T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2027" : helpers.makeTestYear("America/Boise", [
		["2027-03-14T08:59:59+00:00", "01:59:59", "MST", 420],
		["2027-03-14T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2027-11-07T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2027-11-07T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2028" : helpers.makeTestYear("America/Boise", [
		["2028-03-12T08:59:59+00:00", "01:59:59", "MST", 420],
		["2028-03-12T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2028-11-05T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2028-11-05T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2029" : helpers.makeTestYear("America/Boise", [
		["2029-03-11T08:59:59+00:00", "01:59:59", "MST", 420],
		["2029-03-11T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2029-11-04T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2029-11-04T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2030" : helpers.makeTestYear("America/Boise", [
		["2030-03-10T08:59:59+00:00", "01:59:59", "MST", 420],
		["2030-03-10T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2030-11-03T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2030-11-03T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2031" : helpers.makeTestYear("America/Boise", [
		["2031-03-09T08:59:59+00:00", "01:59:59", "MST", 420],
		["2031-03-09T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2031-11-02T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2031-11-02T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2032" : helpers.makeTestYear("America/Boise", [
		["2032-03-14T08:59:59+00:00", "01:59:59", "MST", 420],
		["2032-03-14T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2032-11-07T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2032-11-07T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2033" : helpers.makeTestYear("America/Boise", [
		["2033-03-13T08:59:59+00:00", "01:59:59", "MST", 420],
		["2033-03-13T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2033-11-06T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2033-11-06T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2034" : helpers.makeTestYear("America/Boise", [
		["2034-03-12T08:59:59+00:00", "01:59:59", "MST", 420],
		["2034-03-12T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2034-11-05T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2034-11-05T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2035" : helpers.makeTestYear("America/Boise", [
		["2035-03-11T08:59:59+00:00", "01:59:59", "MST", 420],
		["2035-03-11T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2035-11-04T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2035-11-04T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2036" : helpers.makeTestYear("America/Boise", [
		["2036-03-09T08:59:59+00:00", "01:59:59", "MST", 420],
		["2036-03-09T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2036-11-02T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2036-11-02T08:00:00+00:00", "01:00:00", "MST", 420]
	]),

	"2037" : helpers.makeTestYear("America/Boise", [
		["2037-03-08T08:59:59+00:00", "01:59:59", "MST", 420],
		["2037-03-08T09:00:00+00:00", "03:00:00", "MDT", 360],
		["2037-11-01T07:59:59+00:00", "01:59:59", "MDT", 360],
		["2037-11-01T08:00:00+00:00", "01:00:00", "MST", 420]
	])
};